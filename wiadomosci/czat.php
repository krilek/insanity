<?php
  require("../config.php");
  require_once(FPOMOC);
  require_once(BAZA);
  require_once(SESJA);
  header('Content-type: application/json');
if (isset($_SESSION['zalogowany'])) {
    if (isset($_POST)) {
        // print_r($_POST);
        // echo "\n\n";
        if (isset($_POST['tryb'])) {
            $wynik = array();
            switch ($_POST['tryb']) {
                case 'wiadomosc':
                    if (isset($_POST['wiadomosc']) &&
                        isset($_POST['nadawca']) &&
                        isset($_POST['rozmowa'])) {
                        $wiad = new Wiadomosc($_POST['nadawca'], $_POST['rozmowa'], $_POST['wiadomosc'], time());
                        if ($wiad->sprawdzDane()) {
                            if ($info = $wiad->wyslijWiadomosc()) {
                                $wynik['kod'] = 200;
                                $wynik['trescKomunikatu'] = "Wysłano";
                                $wynik['idWiadomosci'] = $baza->insert_id;
                                echo json_encode($wynik);
                            } else {
                                $wynik['kod'] = 404;
                                $wynik['trescKomunikatu'] = $info;
                                echo json_encode($wynik);
                            }
                        } else {
                            exit();
                        }
                    }
                    break;
                case 'pobierzWiadomosci':
                    //Wczytać rozmowę
                    $rozmowa = new Rozmowa($_POST['idRozmowy']);
                    if ($rozmowa->sprawdzDane() != false) {
                        $wiadomosci = $rozmowa->pobierzWiadomosci(100);
                        if (is_array($wiadomosci )) {
                            $wynik['kod'] = 200;
                            $wynik['trescKomunikatu'] = "Wyszukano wiadomosci";
                            $wynik['iloscWiadomosci'] = count($wiadomosci);
                            $ostatniIndexWiadomosci = $wynik['iloscWiadomosci'] - 1;
                            $wynik['ostatniaWiadomosc'] = $wiadomosci[$ostatniIndexWiadomosci]['ID'];
                            $wynik['wiadomosci'] = $wiadomosci;
                            echo json_encode($wynik);
                        } elseif ($wiadomosci == 0) {
                            $wynik['kod'] = 304;
                            $wynik['trescKomunikatu'] = "Brak wiadomosci";
                            echo json_encode($wynik);
                        } else {
                            $wynik['kod'] = 404;
                            $wynik['trescKomunikatu'] = "Błąd ".$rozmowa->blad." ".$this->ostatnieZapytanie;
                            echo json_encode($wynik);
                        }
                    }
                    break;
                case 'odswiezRozmowe':
                    //Wczytaj ostatnie
                    $rozmowa = new Rozmowa($_POST['idRozmowy']);
                    if ($rozmowa->sprawdzDane() != false) {
                        $wiadomosci = $rozmowa->odswiezWiadomosci($_POST['idOstatniejWiadomosci'], 100);
                        if (is_array($wiadomosci)) {
                            $wynik['kod'] = 200;
                            $wynik['trescKomunikatu'] = "Wyszukano nowe wiadomosci";
                            $wynik['iloscWiadomosci'] = count($wiadomosci);
                            $ostatniIndexWiadomosci = $wynik['iloscWiadomosci'] - 1;
                            $wynik['ostatniaWiadomosc'] = $wiadomosci[$ostatniIndexWiadomosci]['ID'];
                            $wynik['wiadomosci'] = $wiadomosci;
                            echo json_encode($wynik);
                        } elseif ($wiadomosci == 0) {
                            $wynik['kod'] = 304;
                            $wynik['trescKomunikatu'] = "Brak nowych wiadomosci";
                            echo json_encode($wynik);
                        } else {
                            $wynik['kod'] = 404;
                            $wynik['trescKomunikatu'] = "Błąd";
                            echo json_encode($wynik);
                        }
                    }
                    break;
                case 'nowaRozmowaSprawdzenie':
                    if (isset($_POST['odbiorca'])) {
                        $istniejeOdbiorca = false;
                        $nadawca = $_SESSION['idUzytkownika'];
                        $odbiorca = $baza->escape_string($_POST['odbiorca']);
                        if ($nadawca == $odbiorca) {
                            exit();
                        }
                        //Sprawdz czy odbiorca jest w bazie uzytkowników
                        if ($uzytkownik = $baza->query('SELECT ID FROM uzytkownicy WHERE ID='.$odbiorca)) {
                            if ($uzytkownik->num_rows == 1) {
                                $istniejeOdbiorca = true;
                            } else {
                                $wynik['kod'] = 305;
                                $wynik['trescKomunikatu'] = "Użytkownik nie istnieje";
                            }
                        }
                        if ($istniejeOdbiorca) {
                            //Sprawdz czy może istnieje już taka rozmowa
                            $zapytanie = "SELECT ID FROM czat_rozmowa WHERE (IDUzytkownik1=$nadawca && IDUzytkownik2=$odbiorca) || (IDUzytkownik1=$odbiorca && IDUzytkownik2=$nadawca) LIMIT 1";
                            if ($rozmowy = $baza->query($zapytanie)) {
                                if ($rozmowy->num_rows > 0) {
                                    $wynik['kod'] = 306;
                                    $wynik['trescKomunikatu'] = "Rozmowa już istnieje";
                                    $wynik['idRozmowy'] = $rozmowy->fetch_assoc()['ID'];
                                } else {
                                    $wynik['kod'] = 200;
                                    $wynik['trescKomunikatu'] = "Rozmowa nie istnieje";
                                }
                            }
                        }
                        echo json_encode($wynik);
                        //Sprawdz czy jest uzytkownik
                        //Sprawdz czy aktualnie nie istnieje taka rozmowa
                        //Jesli tak to zwróc id tej rozmowy i przełącz na nią
                        //Jeśli nie czekaj na wiadomosc i dopiero
                        //stworz nowa rozmowe i przełącz na nią
                    }
                    break;
                case 'nowaRozmowa':
                    break;
            }
        }
        //Rozmowcy
    } else {
        exit();
    }
}
class Rozmowa
{
    private $idRozmowy;
    private $ostatniaWiadomosc;
    private $idOstatniejWiadomosci;
    private $odbiorca;
    public $ostatnieZapytanie;
    function __construct($id)
    {
        global $baza;
        $this->idRozmowy = $baza->escape_string($id);
    }
    function sprawdzDane()
    {
        global $baza;
        //Sprawdz czy w rozmowie bierze udział uzytkownik sesji
        $this->ostatnieZapytanie = "SELECT * FROM czat_rozmowa WHERE ID=".$this->idRozmowy." && ( IDUzytkownik1=".$_SESSION['idUzytkownika']." || IDUzytkownik2=".$_SESSION['idUzytkownika'].")";
        if ($wynik = $baza->query($this->ostatnieZapytanie)) {
            if ($wynik->num_rows == 1) {
                return true;
            }
        }
        return false;
    }
    function pobierzWiadomosci($ilosc, $przesuniecie = 0)
    {
        global $baza;
        $tablicaZwrotna = array();
        //TODO: dorób ograniczanie ilości i offsety
        if ($przesuniecie > 0) {
            $this->ostatnieZapytanie = "SELECT ID, Nadawca, Tresc, Data 
                        FROM czat_wiadomosc 
                      WHERE IDRozmowy=".$this->idRozmowy." && ID > $przesuniecie LIMIT $ilosc";
        } else {
            $this->ostatnieZapytanie = "SELECT ID, Nadawca, Tresc, Data 
                        FROM czat_wiadomosc 
                      WHERE IDRozmowy=".$this->idRozmowy." LIMIT $ilosc";
        }
                    //   echo $this->ostatnieZapytanie;
        if ($wynik = $baza->query($this->ostatnieZapytanie)) {
            if ($wynik->num_rows == 0) {
                return 0;
            }
            foreach ($wynik as $wiadomosc) {
                $tablicaZwrotna[] = $wiadomosc;
            }
            return $tablicaZwrotna;
        } else {
            return -1;
        }
    }
    function odswiezWiadomosci($nrOstatniejWiadomosci, $iloscDoPobrania = 100)
    {
        return $this->pobierzWiadomosci($iloscDoPobrania, $nrOstatniejWiadomosci);
        global $baza;
    }
}
class Wiadomosc
{
    private $nadawca;
    private $rozmowa;
    private $tresc;
    private $data;
    function __construct($nadawca, $rozmowa, $tresc, $data)
    {
        global $baza;
        $this->nadawca = $baza->escape_string($nadawca);
        $this->rozmowa = $baza->escape_string($rozmowa);
        $this->tresc = $baza->escape_string(htmlspecialchars($tresc, ENT_QUOTES | ENT_HTML5));
        $this->data = $data;
    }

    function sprawdzDane()
    {
        global $baza;
        //Sprawdz czy zalogowany uzytkownik jest autorem wiadomości
        if ($this->nadawca == $_SESSION['idUzytkownika']) {
            //Sprawdz czy rozmowa istnieje
            if (strlen($this->rozmowa) > 0) {
                $zapytanie = "SELECT ID FROM czat_rozmowa WHERE ID=".$this->rozmowa;
                if ($wynik = $baza->query($zapytanie)) {
                    if ($wynik->num_rows > 0) {
                        return true;
                    }
                } else {
                    // echo json_encode($baza->error);
                }
            }
        } else {
            return false;
        }
    }
    function sprawdzTekst()
    {
    }
    function oczyscTekst()
    {
    }
    function wyslijWiadomosc()
    {
        global $baza;
        if ($baza->query("INSERT INTO czat_wiadomosc 
                        (IDRozmowy, Nadawca, Tresc, Data) 
                      VALUE 
                        (".$this->rozmowa.", ".$this->nadawca.", '".$this->tresc."', CURRENT_TIMESTAMP)")) {
            return true;
        } else {
            return $baza->error;
            //ERROR
        }
    }
}
