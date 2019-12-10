<?php
require_once("config.php");
// require_once(BAZA);
 $baza = new mysqli(SERVERNAME, USERNAME, PASSWORD, "testowa");
  mb_internal_encoding("UTF-8");
if ($baza->connect_error) {
    przekieruj(BLAD."?blad=100");
    die("Brak połączenia z bazą");
} else {
    $baza->set_charset("utf8");
}
if (isset($_POST['tryb'])) {
    switch ($_POST['tryb']) {
        case 'powiaty':
            if (isset($_POST['teryt'])) {
                $query = "SELECT * FROM `powiaty` WHERE Wojewodztwo=".$_POST['teryt'];
                // echo $query;
                $powiaty = $baza->query($query);
                // print_r($baza->error);
                echo "<select id='powiaty'>";
                foreach ($powiaty as $wiersz) {
                    echo "<option value='".$wiersz['NrPowiatu']."'>".$wiersz['Nazwa']."</option>";
                }
                echo "</select>";
            }
            // echo "KUPA";
            break;
        case 'miasta':
            if (isset($_POST['teryt']) && isset($_POST['powiat'])) {
                $query = "SELECT * FROM `miasta` WHERE Powiat=".$_POST['powiat']." AND Wojewodztwo=".$_POST['teryt']." ORDER BY `Nazwa`";
                $miasta = $baza->query($query);
                // echo $baza->error;
                echo "<select id='miasta'>";
                foreach ($miasta as $wiersz) {
                    echo "<option value='".$wiersz['ID']."'>".$wiersz['Nazwa']."</option>";
                }
                echo "</select>";
            }
            break;
        case 'wyszukaj':
            if (isset($_POST['szukaj'])) {
                $szukaj = $baza->escape_string($_POST['szukaj']);
                $query = "SELECT `miasta`.`Nazwa` FROM miasta WHERE  `miasta`.`Nazwa` LIKE '%$szukaj%'";
                // $query = "SELECT `wojewodztwa`.`Nazwa`, `powiaty`.`Nazwa`, `miasta`.`Nazwa` FROM wojewodztwa, powiaty, miasta WHERE  `wojewodztwa`.`Nazwa`='$szukaj' OR `powiaty`.`Nazwa`='$szukaj' OR `miasta`.`Nazwa`='$szukaj'";
                // echo $query;
                $miasta = $baza->query($query);
                // echo $baza->error;
                print_r($miasta);
                foreach ($miasta as $wiersz) {
                    echo "<p>".$wiersz['Nazwa']."</p>";
                }
            }
            break;
        default:
            # code...
            break;
    }
}
