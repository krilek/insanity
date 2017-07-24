<?php
//TODO: MOŻESZ TEŻ TO ZROBIĆ FILEEXISTEM i jeśli istnieje to require_once jeśli nie to wyjebane
if (basename(__FILE__) != basename($_SERVER['SCRIPT_FILENAME'])) {
    require_once("config.php");
} else {
    require_once("../config.php");
}
  require_once(BAZA);
    $podpowiedz = "";
if (isset($_GET['tabela']) && isset($_GET['q']) && mb_strlen($_GET['q']) > 1) {
    switch ($_GET['tabela']) {
        case 'ogloszenia':
            $podpowiedz = podpowiedzi($_GET['tabela'], "Tytul", $_GET['q']);
            break;
        case 'miejscowosc':
            $podpowiedz = podpowiedzi($_GET['tabela'], "Nazwa", $_GET['q'], 5, "RodzajMiejscowosci");
            break;
        case 'kategoria':
            $podpowiedz = podpowiedzi($_GET['tabela'], "Nazwa", $_GET['q'], 5);
            break;
    }
    header('Content-type: application/json');
    echo $podpowiedz;
}
function podpowiedzi($tabela, $kolumna, $zapytanie, $limit = 5, $sortuj = null)
{
    global $baza;
    $zapytanie = $baza->escape_string($zapytanie);
    $tabela = $baza->escape_string($tabela);
    $zapytanie = "SELECT $kolumna FROM $tabela WHERE $kolumna LIKE '$zapytanie%'";
    if ($sortuj) {
        $zapytanie .= " ORDER BY $sortuj DESC ";
    }
    $zapytanie .= "LIMIT $limit ";
        echo $zapytanie;
        // SELECT miejscowosc.Nazwa, wojewodztwo.Nazwa, powiat.Nazwa FROM miejscowosc JOIN wojewodztwo ON wojewodztwo.TERYT=miejscowosc.Wojewodztwo JOIN powiat ON powiat.NrPowiatu=miejscowosc.Powiat && powiat.Wojewodztwo=miejscowosc.Wojewodztwo WHERE miejscowosc.Nazwa LIKE 'Częstochowa%' ORDER BY RodzajMiejscowosci DESC
        // SELECT * FROM miejscowosc JOIN powiat ON powiat.NrPowiatu=miejscowosc.Powiat && powiat.Wojewodztwo=miejscowosc.Wojewodztwo  JOIN wojewodztwo ON wojewodztwo.TERYT=powiat.Wojewodztwo  WHERE miejscowosc.Nazwa LIKE 'Gdańsk%' ORDER BY RodzajMiejscowosci DESC
    if ($wyniki = $baza->query($zapytanie)) {
        $output = array();
        foreach ($wyniki as $wynik) {
            $output[] = $wynik[$kolumna];
        }
        return json_encode($output);
    } else {
        // echo $baza->error;
        return "";
    }
}
function szukajDiv()
{
    return '<div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <div class="input-group btn-block">
            <input id="wyszukiwarka" class="form-control " placeholder="Wyszukaj: tytuł, miejscowość, kategorię..." type="text">
            <div class="input-group-btn search-panel">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                &nbsp;<span class="caret"></span>&nbsp;
              </button>
              <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="opcje-wyszukiwania">
                  <li role="formularz">
                    <div class="container-fluid">
                      <form class="form-horizontal" role="form" style="padding-left: 5px;padding-right: 5px;">
                              <legend style="margin-bottom: 5px;">Wyszukaj w:</legend>
                            <div class="form-group">
                              <label for="miejscowosc">Miejscowość</label>
                              <input type="text" class="form-control" id="wyszukiwarka-miejscowosc" placeholder="Miejscowość">
                            </div>
                            <div class="form-group ">
                              <label for="kategoria">Kategoria</label>
                              <input class="form-control" id="wyszukiwarka-kategoria" type="text" placeholder="Kategoria">
                            </div>
                          </form>
                        </div>
                  </li>
              </ul>
                
            </div>
            <span class="input-group-btn ">
                <button class="btn btn-info " type="button ">Szukaj&nbsp;<span class="glyphicon glyphicon-search "></span></button>
            </span>
          </div>
        </div>
      </div>';
}
