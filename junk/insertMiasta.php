<?php
  $plik = fopen("miastaZID2.csv", "r");
  require_once("../config.php");
  require_once(FPOMOC);
  require_once(BAZA);
  mb_internal_encoding("UTF-8");

//     if(feof($plik))
// }
$counter = 0;
$query = "INSERT INTO miejscowosc2 (ID, ID2, Powiat, Wojewodztwo, Nazwa, RodzajMiejscowosci) VALUES ";
// while (($data = fgetcsv($plik, 0, ';')) !== false) {
for ($i=1; $i<=1030159; $i++) {
    $data = fgetcsv($plik, 0, ';');
    if ($data !== false) {
        $query.= "(".$data[0].",".$data[1].",".$data[2].",".$data[3].",'".$data[4]."',".$data[5].")".PHP_EOL;
        // '96','99','98','95','0','1','2','3','4','5','6','7'
        // if ($counter == 100) {
        if ($i%200 == 0) {
            // if ($i>100000) {
            // }
            if (!$baza->query($query)) {
                echo $baza->error;
                echo $query."<br>";
            }
            $query = "INSERT INTO miejscowosc2 (ID, ID2,Powiat,Wojewodztwo,Nazwa, RodzajMiejscowosci) VALUES";
        } else {
            $query .= ",";
        }
    } else {
        if (mb_substr($query, -1) == ",") {
            $query = mb_substr($query, 0, -1);
        }
        echo $query;
        if (!$baza->query($query)) {
            echo $baza->error;
        }
        break;
    }
}
// echo $query."</br>";
// echo mb_substr($query, -1) == ',';
        //    $query = mb_substr($query, 0, -1);
            // echo $query;
