<?php
  session_start();
if (!isset($_SESSION['miejscowosc'])) {
    //TODO: Tu ogarniesz miejscowosc
}
  //TODO: LISTA URL KTÓRYCH MA NIE ZAPISYWAĆ z NP REGEXAMI
if (preg_match('/(blad.php)/', $_SERVER['REQUEST_URI']) != 1) {
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
}

//TODO: Tu zrobić blacklistę stron które wymagają sesji i bez niej nie wystartują
//FIXME: WYLOGOWANIE RESETUJE?!
if (!isset($_SESSION['ostatnieOgloszenia'])) {
    if (isset($_COOKIE['ostatnieOgloszenia'])) {
        $_SESSION = json_decode($_COOKIE['ostatnieOgloszenia']);
    } else {
        $_SESSION['ostatnieOgloszenia'] = array();
    }
}
    // $_SESSION['ostatnieOgloszenia'] = array();
  //Usuwanie zbędnych slashy
if (isset($_SESSION['url'])) {
    if (mb_strlen($_SESSION['url']) > 1) {
        while ($_SESSION['url'][0] == "/") {
            $_SESSION['url'] = substr($_SESSION['url'], 1);
        }
    }
}
if ($_SERVER['SERVER_NAME'] == "localhost" && isset($sesjaDebug)) {
    print_r($_SESSION);
}
