<?php
    require_once(FPOMOC);

    $baza = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    if ($baza->connect_error) {
        przekieruj(BLAD."?blad=100");
        die("Brak połączenia z bazą");
    }
    $baza->set_charset("utf8");
