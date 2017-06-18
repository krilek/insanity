<?php
    include_once(FPOMOC);
    // define('USERNAME', 'krilek');
    // define('PASSWORD', 'dupadupa12');
    // define('SERVERNAME', 'mysql.cba.pl');
    // define('DBNAME', 'krilek');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('SERVERNAME', 'localhost');
    define('DBNAME', 'ogloszenia');
    $baza = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    if($baza->connect_error){
      przekieruj("../blad.php?blad=100");
      die("Brak połączenia z bazą");
    }
    $baza->set_charset("utf8");
?>
