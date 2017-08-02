<?php
    require_once("../config.php");
    require_once(FPOMOC);
    require_once(BAZA);
if (isset($_GET['tabela'])) {
    header('Content-type: application/json');
    $zapytanie = "a";
    switch ($_GET['tabela']) {
        case "wojewodztwo":
            $zapytanie = "SELECT * FROM wojewodztwo";
            break;
        case "powiat":
            if (isset($_GET['wojewodztwo'])) {
                $woj = $baza->escape_string($_GET['wojewodztwo']);
                $zapytanie = "SELECT NrPowiatu, Nazwa FROM powiat WHERE Wojewodztwo=$woj ORDER BY NrPowiatu DESC";
            }
            break;
        case "miejscowosc":
            if (isset($_GET['wojewodztwo']) && isset($_GET['NrPowiatu'])) {
                $woj = $baza->escape_string($_GET['wojewodztwo']);
                $pow = $baza->escape_string($_GET['NrPowiatu']);
                $zapytanie = "SELECT ID,ID2,Nazwa FROM miejscowosc WHERE Wojewodztwo=$woj && Powiat=$pow ORDER BY `RodzajMiejscowosci` ASC";
            }
            break;
        case "dzielnica":
            if (isset($_GET['ID2'])) {
                $m = $baza->escape_string($_GET['ID2']);
                $zapytanie = "SELECT ID,ID2, Nazwa FROM miejscowosc WHERE ID2 = $m";
            }
            break;
    }
    $json = "";
    if ($zapytanie != "" && ($wyniki = $baza->query($zapytanie))) {
        $przedJson = array();
        foreach ($wyniki as $wynik) {
            $przedJson[] = $wynik;
        }
        $json = json_encode($przedJson);
    }
    echo $json;
}
function wypiszWojewodztwa($ilKolumn = 4)
{
    global $baza;
    $wyniki = $baza->query("SELECT * FROM wojewodztwo");
    $i = 0;
    foreach ($wyniki as $wojewodztwo) {
        if ($i%$ilKolumn == 0) {
            echo "<div class='col-xs-12'>
                    <div class='btn-group btn-group-justified'>";
        }
        echo "<a onclick='wybor({wojewodztwo:".$wojewodztwo['TERYT']."}, this)' target='powiat' class='btn btn-info'>".$wojewodztwo['Nazwa']."</a>";
        $i++;
        if ($i%$ilKolumn == 0) {
            echo "  </div>
                </div>";
        }
    }
    if ($i%$ilKolumn != 0) {
            echo "  </div>
                </div>";
    }
}
