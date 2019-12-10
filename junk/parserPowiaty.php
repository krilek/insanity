<?php
  $plik = fopen("indane.csv", "r");
  $zapis = fopen("powiatyZrodzajem.csv", "w");
  // setlocale(LC_CTYPE, "utf-8");
  fwrite($zapis, "ID,NrPowiatu;Wojewodztwo;Nazwa;Typ".PHP_EOL);
$counter = 1;
$il = 0;
while (($data = fgetcsv($plik, 0, ';')) !== false) {
    // if (isset($data[5]) && $data[5] == "powiat" || $data[5] == "miasto na prawach powiatu") {
    if ($data[2] == "" && $data[3] == "") {
        $linia = $counter.";".$data[1].";".$data[0].";".$data[4];
        switch ($data[5]) {
            case 'gmina miejska':
                $linia .= ";1";
                break;
            case 'gmina wiejska':
                $linia .= ";5";
                break;
            case 'gmina miejsko-wiejska':
                $linia .= ";4";
                break;
            case 'dzielnica':
                $linia .= ";3";
                break;
            case 'delegatura':
                $linia .= ";2";
                break;
        }
        $linia.=PHP_EOL;

        $counter++;
        fwrite($zapis, $linia);
        echo "<pre>";
        print_r($data);
        $il++;
        echo "</pre>";
    }
}
echo $il;
