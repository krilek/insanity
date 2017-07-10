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
    } elseif (strlen($login) < 5) {
        return 4;
    } elseif (strlen($login) > 25) {
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
