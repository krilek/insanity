<?php
// TODO: https://www.w3schools.com/php/php_error.asp
function przekieruj($url, $status = 303)
{
    //FIXME: zamkniecie polaczenia z baza
    //global $baza
    //$baza->close();
    if ($url == ROOT."/") {
        header('Location: '.ROOT, true, $status);
    } else {
        header('Location: '.$url, true, $status);
    }
    die();
}
function wyslijMail($do, $wiadomosc, $temat)
{
    $naglowski  = "MIME-Version: 1.0\r\n";
    $naglowski .= "Content-type: text/html; charset=UTF-8\r\n";
    $naglowski .= "From: test@lajtowetesty.cba.pl\r\n";
    $naglowski .= "Reply-To: test@lajtowetesty.cba.pl\r\n";

    return mail($do, $temat, $wiadomosc, $naglowski);
}

function sprawdzLogin($login)
{
    if (preg_match('[\W]', $login)) {
        return 3;
    } elseif (mb_strlen($login) < 5) {
        return 4;
    } elseif (mb_strlen($login) > 25) {
        return 5;
    } else {
        return $login;
    }
}

function sprawdzZalogowany()
{
    if (!isset($_SESSION['zalogowany'])) {
        przekieruj(BLAD."?blad=101");
    }
}

function skrocTekst($string, $dlugosc)
{
    return (mb_strlen($string) > $dlugosc ? mb_substr($string, 0, $dlugosc)."..." : $string);
}
function namierzajKlienta($ip)
{
    global $baza;
    
    try {
        $infoJson = @file_get_contents('http://freegeoip.net/json/'.$ip);
        if ($infoJson !== false) {
            $miejscowosc = json_decode($infoJson)->city;
            if ($miejscowosc != "" || $miejscowosc != null) {
                $miejscowosc = $baza->escape_string($miejscowosc);
                $zapytanie = "SELECT * FROM miejscowosc WHERE Nazwa='$miejscowosc'";
                if ($wynik = $baza->query($zapytanie)) {
                    if ($wynik->num_rows == 1) {
                        $wynik = $wynik->fetch_assoc();
                        return $wynik['ID'];
                        //TODO: Zrób zwracanie -1, na dole popraw tego ifa
                    } else {
                        return null;
                    }
                } else {
                    return null;
                }
            }
        } else {
            return null;
        }
    } catch (Exception $e) {
        return null;
      //TODO: log
    }
    // echo $infoJson;
}
function sprawdzLokalizacje()
{
    global $baza;
    if (!isset($_COOKIE['miejscowosc'])) {
  //Gdy nie ma cookie
        if (!isset($_SESSION['miejscowosc'])) {
              //Gdy nie ma w sesji miejscowowsci
            if (($idMiejscowosci = namierzajKlienta($_SERVER['REMOTE_ADDR'])) != null) {
              //Określ na podstawie ip
                $_SESSION['miejscowowsc'] = $idMiejscowosci;
                setcookie('miejscowosc', $_SESSION['miejscowosc'], time() + (86400 * 30), "/");
            } else {
                $_SESSION['miejscowosc'] = -1;
                setcookie('miejscowosc', $_SESSION['miejscowosc'], time() + (86400 * 30), "/");
            }
        } else {
              //Gdy jest w sesji
            setcookie('miejscowosc', $_SESSION['miejscowosc'], time() + (86400 * 30), "/");
        }
    } else {
          //Gdy jest cookie
        if (isset($_SESSION['zalogowany']) && $_COOKIE['miejscowosc'] != $_SESSION['miejscowosc']) {
          //Gdy są różne aktualizuj na podstawie ustawień użytkownika
            setcookie('miejscowosc', $_SESSION['miejscowosc'], time() + (86400 * 30), "/");
        } elseif (!isset($_SESSION['miejscowowsc'])) {
          // Gdy nie jest zalogowany ustaw na podstawie cookie
            $_SESSION['miejscowosc'] = $baza->escape_string($_COOKIE['miejscowosc']);
        }
        echo $_COOKIE['miejscowosc'];
    }
}
