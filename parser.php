<?php
  require_once('config.php');
  ini_set('max_execution_time', 300);
  require_once(BAZA);
  $plik = simplexml_load_file("SIMC_Urzedowy_2017-05-28.xml") or die ("NIE PYKŁO");
  $ilM = count($plik->catalog->row);
  echo $ilM;
  // for($j=0;$j<$ilM;$j+=100){
  //   $zapytanie = "INSERT INTO miasta (Nazwa, Woj) VALUES";
  //   for($i=$j;$i<($j+100);$i++){
  //
  //     $wiersz = $plik->catalog->row[$i];
  //     // if($wiersz->RODZ_GMI == '1')
  //       $zapytanie .= "('$wiersz->NAZWA', $wiersz->WOJ),";
  //   }
  //   $zapytanie = substr($zapytanie, 0, -1);
  //   echo $zapytanie.'<br><br><br><br><br>';
  //   // echo PHP_EOL;
  // }
  $zapytanie = "INSERT INTO miasta (Nazwa, Woj) VALUES";
  for($j=0;$j<$ilM;$j++){

      $wiersz = $plik->catalog->row[$j];
      if($wiersz->RODZ_GMI == '1')
        $zapytanie .= "('$wiersz->NAZWA', $wiersz->WOJ),";
    // echo PHP_EOL;
  }
  $zapytanie = substr($zapytanie, 0, -1);
  echo $zapytanie.'<br><br><br><br><br>';
  // $baza->query($zapytanie);

 ?>
