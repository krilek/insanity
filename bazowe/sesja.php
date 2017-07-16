<?php
  session_start();
  //TODO: LISTA URL KTÓRYCH MA NIE ZAPISYWAĆ z NP REGEXAMI
  $_SESSION['url'] = $_SERVER['REQUEST_URI'];
  
  //Usuwanie zbędnych slashy
if (isset($_SESSION['url'])) {
    if (mb_strlen($_SESSION['url']) > 1) {
        while ($_SESSION['url'][0] == "/") {
            $_SESSION['url'] = substr($_SESSION['url'], 1);
        }
    }
}
if ($_SERVER['SERVER_NAME'] == "localhost") {
    print_r($_SESSION);
}
