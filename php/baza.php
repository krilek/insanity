<?php
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('SERVERNAME', 'localhost');
    define('DBNAME', 'ogloszenia');
    $baza = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    if($baza->connect_error){
      die("Brak połączenia z bazą");
    }
    $baza->set_charset("utf8");
?>
