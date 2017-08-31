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
                            $wynik['trescKomunikatu'] = "Błąd ".$rozmowa->blad." ".$this->ostatnieZapytanie;
                            echo json_encode($wynik);
                        }
                    }
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
    public $blad;
    function __construct($id)
    {
        global $baza;
        $this->idRozmowy = $baza->escape_string($id);
    }
    function sprawdzDane()
    {
        return true;
        
        //Sprawdz czy w rozmowie bierze udział uzytkownik sesji
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
            $this->blad = $baza->error;
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
