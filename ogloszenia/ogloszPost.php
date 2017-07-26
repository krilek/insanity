<?php
require_once("../config.php");
require_once(FPOMOC);
require_once(BAZA);
require_once(SESJA);
function sprawdzKategorie($kategoria)
{
    global $baza;
    if (filter_var($kategoria, FILTER_VALIDATE_INT) !== false) {
        if ($wynik = $baza->query("SELECT ID FROM kategoria WHERE ID='$kategoria'")) {
            if ($wynik->num_rows == 1) {
                // TODO: ZROBIĆ GARBAGE COLLECTING
                //NR KATEGORII POPRAWNY
                return $kategoria;
            } else {
                przekieruj(BLAD."?blad=36");
            }
        } else {
            przekieruj(BLAD."?blad=32");
        }
    } else {
        przekieruj(BLAD."?blad=36");
    }
    return null;
}
function sprawdzCene($cena)
{
    $test = preg_match("/^\d+([,]\d{1,2})?$/", $cena);
    if ($test == 1) {
        return str_replace(",", ".", $cena);
        //CORRECT
        return $cena;
    } elseif ($test === 0) {
        //BRAK DOPASOWANIA
        przekieruj(BLAD."?blad=37");
    }
}
function sprawdzTyp($typ)
{
    global $baza;
    if (filter_var($typ, FILTER_VALIDATE_INT) !== false) {
        if ($wynik = $baza->query("SELECT ID, CenaPotrzebna FROM typogloszenia WHERE ID='$typ'")) {
            if ($wynik->num_rows == 1) {
                //NR KATEGORII POPRAWNY
                return $wynik->fetch_assoc();
                // TODO: ZROBIĆ GARBAGE COLLECTING
            } else {
                //NIE MA TAKIEJ KATEGORII
                przekieruj(BLAD."?blad=38");
            }
        } else {
            //BŁĄD Z BAZĄ
            przekieruj(BLAD."?blad=32");
        }
    } else {
        //Nie INT
        przekieruj(BLAD."?blad=38");
    }
}

function sprawdzTytul($tytul)
{
    global $baza;
    if (mb_strlen($tytul) >= 5 && mb_strlen($tytul) <= 50) {
        $tytul = $baza->escape_string(htmlspecialchars($tytul));
        return $tytul;
    } else {
         //ERROR
        przekieruj(BLAD."?blad=39");
    }
}

function sprawdzZdjecie($nr, $rozszerzenie)
{
// // Check if image file is a actual image or fake image
    $info = getimagesize($_FILES["zdjecia"]["tmp_name"][$nr]);
    if ($info !== false) {
        echo "Plik jest zdjęciem format: " . $info["mime"] . ".";
    } else {
        echo "Plik nie jest zdjęciem";
        return false;
    }
// // Check file size
    if ($_FILES["zdjecia"]["size"][$nr] > 500000) {
        echo "Plik jest za duży";
        return false;
    }
// // Allow certain file formats
    if ($rozszerzenie != "jpg" && $rozszerzenie != "png" && $rozszerzenie != "jpeg") {
        echo "Dozwolone tylko jpg, png";
        return false;
    }
    return true;
    //TODO: MOŻE JAKAŚ KOMPRESJA?
}
function przeslijZdjecia($nrOgloszenia)
{
    //TABLICA PLIKÓW DO BAZY
    $pliki = array();
    
    //Sprawdz errory
    $bledy = 0;
    $nrZdjecia = 0;
    $iloscPlikow;

    if (count($_FILES['zdjecia']['error']) < MAX_ZDJEC) {
        $iloscPlikow = count($_FILES['zdjecia']['error']);
    } else {
        $iloscPlikow = MAX_ZDJEC;
    }

    for ($i=0; $i<$iloscPlikow; $i++) {
        if ($_FILES['zdjecia']['error'][$i] == 0) {
            //PLIK PRZESŁANY POPRAWNIE
            $rozszerzenie = pathinfo($_FILES["zdjecia"]["name"][$i], PATHINFO_EXTENSION);
            //Sprawdz czy informacje są poprawne
            if (sprawdzZdjecie($i, $rozszerzenie)) {
                //Przygotuj nazwę
                $nazwaPliku = $nrOgloszenia."_".$nrZdjecia;
                while (file_exists(I_IMG_OGLOSZENIA.$nazwaPliku.".".$rozszerzenie)) {
                    echo I_IMG_OGLOSZENIA.$nazwaPliku.".".$rozszerzenie."<br>";
                    $nrZdjecia++;
                    $nazwaPliku = $nrOgloszenia."_".$nrZdjecia;
                }
                $sciezkaPliku = I_IMG_OGLOSZENIA.$nazwaPliku.".".$rozszerzenie;
                //Przenies plik
                if (move_uploaded_file($_FILES["zdjecia"]["tmp_name"][$i], $sciezkaPliku)) {
                    echo "Plik " .$nazwaPliku. " został wysłany.";
                    //Przygotuj tablice zwrotna
                    $plik = array();
                    $nrZdjecia++;
                    $plik["nazwa"] = $nazwaPliku.".".$rozszerzenie;
                    $plik["mime"] = $_FILES["zdjecia"]["type"][$i];
                    $plik["nrogloszenia"] = $nrOgloszenia;
                    // print_r($plik);
                    array_push($pliki, $plik);
                } else {
                    echo "Plik nie został przeniesiony na serwer";
                }
            } else {
                $bledy++;
            }
        } else {
            //PROBLEM Z PRZESŁANIEM PLIKU
        }
    }
    if ($bledy > 0) {
        $pliki['bledy'] = $bledy;
    }
    return $pliki;
}

function dodajOgloszenie($dane, $nrUzytkownika)
{
    global $baza;
    if (!isset($dane['cena'])) {
        $dane['cena'] = "NULL";
    }
    $dodajOgloszenie =
    "INSERT INTO `ogloszenia` 
    (Uzytkownik,Tytul,Kategoria,Tresc,Typ,Cena,DataUtworzenia) VALUES
    ($nrUzytkownika,'".$dane['tytul']."', ".$dane['kategoria'].", '".$dane['tresc']."',".$dane['typ'].",".$dane['cena'].",NOW())";
    echo $dodajOgloszenie;
    //TODO: ZASTANÓW SIĘ KURWA CZY NIE ZROBIĆ PROCEDUR
    if ($baza->query($dodajOgloszenie)) {
        return $baza->insert_id;
    } else {
        echo $baza->error;
        przekieruj(BLAD."?blad=32");
    }
}

function zdjecieDoBazy($lista)
{

    print_r($lista);
    return 1;
}

    //FORMULARZ
if (isset($_POST)) {
    echo "<pre>";
    // print_r($_POST);
    print_r($_FILES);
    echo "</pre>";
    //FIXME: BRAK SPRAWDZANIA CENY
    if (filter_has_var(INPUT_POST, 'tytul')     && !empty($_POST['tytul']) &&
        filter_has_var(INPUT_POST, 'tresc')     && !empty($_POST['tresc']) &&
        filter_has_var(INPUT_POST, 'typ')       && !empty($_POST['typ'])   &&
        filter_has_var(INPUT_POST, 'kategoria') && !empty($_POST['kategoria'])) {
        $czysteDane =
                array("tytul"     => sprawdzTytul($_POST['tytul'], "tytul"),
                      "kategoria" => sprawdzKategorie($_POST['kategoria']),
                      "tresc"     => $baza->escape_string(htmlspecialchars($_POST['tresc'])),
                      "typ" => ""
                      );
                    //   "typ"       => sprawdzDane($_POST['typ'], "typ"),
                    //   "cena"      => sprawdzDane($_POST['cena'], "cena")
        $typTab = sprawdzTyp($_POST['typ']);
        if (is_array($typTab)) {
            $czysteDane['typ'] = $typTab['ID'];
            if ($typTab['CenaPotrzebna'] == 1) {
                if (filter_has_var(INPUT_POST, 'cena') &&
                !empty($_POST['cena'])) {
                    $czysteDane['cena'] = sprawdzCene($_POST['cena']);
                } else {
                    przekieruj(BLAD."?blad=40");
                }
            }
        }
        //DANE SPRAWDZONE
        //DODAJ DO BAZY ZWROC NR OGLOSZENIA
        $nrOgloszenia = dodajOgloszenie($czysteDane, $_SESSION['idUzytkownika']);
        if (isset($_FILES["zdjecia"])) {
            //GDY NIE ZOSTAŁ WYSŁANY ŻADEN PLIK (INPUT PUSTY)
            if ($_FILES['zdjecia']['error'][0] != 4) {
                $lista = przeslijZdjecia($nrOgloszenia);
                zdjeciaDoBazy($lista);
                // if (isset($lista['bledy'])) {
                //     przekieruj(BLAD."?blad=41");
                // }
            }
        }
    } else {
        //DANE NIEPELNE
        przekieruj(BLAD."?blad=42");
    }
} else {
    //INCLUDE
}

function zdjeciaDoBazy($pliki)
{
    global $baza;
    $bledy = array();
    print_r($pliki);
    if (isset($pliki['bledy'])) {
        array_pop($pliki);
    }
    print_r($pliki);
    $iloscPlikow = count($pliki);
    if ($dodaj = $baza->prepare("INSERT INTO zdjecia (Ogloszenie, NazwaPliku, MIME) VALUES (?, ?, ?)")) {
        for ($i=0; $i<$iloscPlikow; $i++) {
            $dodaj->bind_param("iss", $pliki[$i]['nrogloszenia'], $pliki[$i]['nazwa'], $pliki[$i]['mime']);
            if (!$dodaj->execute()) {
                array_push($bledy, $i);
                echo $baza->error;
            }
        }
        $dodaj->close();
    } else {
        echo $baza->error;
    }
    return $bledy;
}
