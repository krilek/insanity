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
            $podpowiedz = podpowiedzi($_GET['tabela'], "Nazwa", $_GET['q'], null, "RodzajMiejscowosci");
            break;
        case 'kategoria':
            $podpowiedz = podpowiedzi($_GET['tabela'], "Nazwa", $_GET['q'], 10);
            break;
    }
    header('Content-type: application/json');
    echo $podpowiedz;
}
function podpowiedzi($tabela, $kolumna, $input, $limit = 5, $sortuj = null)
{
    global $baza;
    $input = $baza->escape_string($input);
    $zapytanie = "SELECT ";
    if ($tabela != 'miejscowosc') {
        $zapytanie .= "$kolumna FROM $tabela";
        $zapytanie .= " WHERE ";
        $zapytanie .= $kolumna;
    } else {
        $zapytanie .= "miejscowosc.$kolumna as Miejscowosc, powiat.Nazwa as Powiat, wojewodztwo.Nazwa as Wojewodztwo FROM $tabela 
                        JOIN powiat ON powiat.NrPowiatu = miejscowosc.Powiat && 
                                    powiat.Wojewodztwo = miejscowosc.Wojewodztwo
                        JOIN wojewodztwo ON wojewodztwo.TERYT = miejscowosc.Wojewodztwo";
        $zapytanie .= " WHERE miejscowosc.$kolumna";
    }
        $zapytanie .=" LIKE ";
        $zapytanie .= " '%$input%' ";
    if ($sortuj) {
        $zapytanie .= "ORDER BY $sortuj ";
    }
    if ($limit) {
        $zapytanie .= "LIMIT $limit ";
    }
        // echo $zapytanie;
        // SELECT miejscowosc.Nazwa, wojewodztwo.Nazwa, powiat.Nazwa FROM miejscowosc JOIN wojewodztwo ON wojewodztwo.TERYT=miejscowosc.Wojewodztwo JOIN powiat ON powiat.NrPowiatu=miejscowosc.Powiat && powiat.Wojewodztwo=miejscowosc.Wojewodztwo WHERE miejscowosc.Nazwa LIKE 'Częstochowa%' ORDER BY RodzajMiejscowosci DESC
        // SELECT * FROM miejscowosc JOIN powiat ON powiat.NrPowiatu=miejscowosc.Powiat && powiat.Wojewodztwo=miejscowosc.Wojewodztwo  JOIN wojewodztwo ON wojewodztwo.TERYT=powiat.Wojewodztwo  WHERE miejscowosc.Nazwa LIKE 'Gdańsk%' ORDER BY RodzajMiejscowosci DESC
    if ($wyniki = $baza->query($zapytanie)) {
        $output = array();
        foreach ($wyniki as $wynik) {
            if ($tabela == 'miejscowosc') {
                $output[] = $wynik['Miejscowosc'].($wynik['Powiat'] != $wynik['Miejscowosc']? ", ".$wynik['Powiat']:"");
            } else {
                $output[] = $wynik[$kolumna];
                $output[] = $wynik[$kolumna];
            }
        }
        return json_encode($output);
    } else {
        // echo $baza->error;
        return "";
    }
}
//TODO: Spróbować zamienić dropdown na popover https://stackoverflow.com/questions/12128425/contain-form-within-a-bootstrap-popover
// https://www.w3schools.com/bootstrap/bootstrap_ref_js_popover.asp
function szukajDiv()
{
    $szukajka = '<div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
          <div class="input-group btn-block">
            <div id="wyszukiwarka">
            <input class="form-control typeahead" id="wysz-input" placeholder="Wyszukaj: tytuł, miejscowość, kategorię..." type="text">
            </div>
            <div class="input-group-btn search-panel">
              <button type="button" id="dodatkowe-opcje" class="btn btn-default" title="Wyszukaj w: " data-toggle="popover" data-html="true" data-placement="auto bottom" data-content="';
    $szukajka .="<form class='form-horizontal' role='form'>
                    <div class='form-group' id='wyszukiwarka-miejscowosc'>
                        <label for='miejscowosc'>Miejscowość</label>
                        <input type='text' class='form-control typeahead' placeholder='Miejscowość'>
                    </div>
                    <div class='form-group' id='wyszukiwarka-kategoria'>
                    <label for='kategoria'>Kategoria</label>
                    <input class='form-control typeahead' type='text' placeholder='Kategoria'>
                    </div>
                </form>";
     $szukajka .='">
                &nbsp;<span class="caret"></span>&nbsp;
              </button>';
            $szukajka.= '</div>
            <span class="input-group-btn ">
                <button class="btn btn-info " type="button ">Szukaj&nbsp;<span class="glyphicon glyphicon-search "></span></button>
            </span>
          </div>
        </div>
      </div>';
      return $szukajka;
}
// function szukajDiv()
// {
//     $szukajka = '<div class="row">
//         <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
//           <div class="input-group btn-block">
//             <div id="wyszukiwarka">
//             <input class="form-control typeahead" id="wysz-input" placeholder="Wyszukaj: tytuł, miejscowość, kategorię..." type="text">
//             </div>
//             <div class="input-group-btn search-panel">
//               <button type="button" id="dodatkowe-opcje" class="btn btn-default" title="Wyszukaj w: " data-toggle="popover" data-html="true" data-placement="bottom">
//                 &nbsp;<span class="caret"></span>&nbsp;
//               </button>';
//             $szukajka .= '<div id="popover-formularz" class="hide"> 
//                             <div role="opcje-wyszukiwania" class="container-fluid">
//                             <form class="form-horizontal" role="form">
//                                     <div class="form-group" id="wyszukiwarka-miejscowosc">
//                                     <label for="miejscowosc">Miejscowość</label>
//                                     <input type="text" class="form-control typeahead" id="wyszukiwarka-miejscowosc" placeholder="Miejscowość">
//                                     </div>
//                                     <div class="form-group" id="wyszukiwarka-kategoria">
//                                     <label for="kategoria">Kategoria</label>
//                                     <input class="form-control typeahead" type="text" placeholder="Kategoria">
//                                     </div>
//                                 </form>
//                                 </div>
//                           </div>';
//             $szukajka.= '</div>
//             <span class="input-group-btn ">
//                 <button class="btn btn-info " type="button ">Szukaj&nbsp;<span class="glyphicon glyphicon-search "></span></button>
//             </span>
//           </div>
//         </div>
//       </div>';
//       return $szukajka;
// }
