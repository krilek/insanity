<?php
  session_start();
  //TODO: LISTA URL KTÓRYCH MA NIE ZAPISYWAĆ
  $_SESSION['url'] = $_SERVER['REQUEST_URI'];
  
  //Usuwanie zbędnych slashy
if (isset($_SESSION['url'])) {
    if (strlen($_SESSION['url']) > 1) {
        while ($_SESSION['url'][0] == "/") {
            $_SESSION['url'] = substr($_SESSION['url'], 1);
        }
    }
}
if ($_SERVER['SERVER_NAME'] == "localhost") {
    print_r($_SESSION);
}
