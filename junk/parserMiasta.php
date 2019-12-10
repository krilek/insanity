<?php
  $plik = fopen("miasteczka.csv", "r");
  $zapis = fopen("miastaZID2.csv", "w");
  // setlocale(LC_CTYPE, "utf-8");
  fwrite($zapis, "ID;NrPowiatu;Wojewodztwo;Nazwa;Rodzaj_Miejscowosci".PHP_EOL);
while (($data = fgetcsv($plik, 0, ';')) !== false) {
    // if ($data[7] == $data[8]) {
    //     echo "<pre>";
    //     print_r($data);
    //     echo "</pre>";
    // }
        $linia = $data[7].";".$data[8].";".$data[1].";".$data[0].";".$data[6].";".$data[4].PHP_EOL;
        fwrite($zapis, $linia);
}
// echo $il;
