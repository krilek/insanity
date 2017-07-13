<?php
  require_once("../config.php");
  require_once(SESJA);
  require_once(FPOMOC);
  sprawdzZalogowany();
  require_once(BAZA);
?>

  <!doctype html>
  <html lang="pl">
    <?php require_once(HEAD);?>
  <style>
    .page-header {
      margin-top: 15px;
      margin-bottom: 10px;
    }
    .media-left img{
      width: 128px;
      height: 128px;
    }
    </style>

  <body>
    <?php require_once(NAVBAR);?>
    <div class="container">
      <div class="row hidden-xs">
        <div class="col-sm-12">
          <div class="page-header">
            <h1>Ogłoszenia</h1>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
        <!--TODO: DAĆ BORDER NA DOLE UL-->
          <ul class="nav nav-tabs nav-justified">
            <li role="presentation"><a href="dodaj_ogloszenie.php">Dodaj ogłoszenie</a></li>
            <li role="presentation"><a href="#">Wszystkie ogłoszenia</a></li>
            <li role="presentation"><a href="#">Aktywne ogłoszenia</a></li>
            <li role="presentation"><a href="#">Zakończone ogłoszenia</a></li>
            <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                Wyszukaj ofertę <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                ...
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
            
            <?php
              $uzytkownik = $_SESSION['idUzytkownika'];
                    
              $zapytanie = "SELECT 
                                ogloszenia.ID,ogloszenia.Tytul, 
                                ogloszenia.Tresc, ogloszenia.Cena,
                                kategorie.Nazwa as Kategoria, typogloszenia.Nazwa as Typ,
                                typogloszenia.CenaPotrzebna, ogloszenia.DataUtworzenia FROM ogloszenia 
                                  JOIN kategorie ON `kategorie`.ID = `ogloszenia`.Kategoria 
                                  JOIN typogloszenia ON `typogloszenia`.ID = `ogloszenia`.Typ 
                            WHERE `Uzytkownik` = $uzytkownik";
              // TODO: TU SKOŃCZYŁEŚ DOREGULUJ WYBIERANIE KOLUMN
              //SELECT * FROM ogloszenia JOIN kategorie ON `kategorie`.ID = `ogloszenia`.Kategoria JOIN typogloszenia ON `typogloszenia`.ID = `ogloszenia`.Typ WHERE `Uzytkownik` = 3
              // $zapytanie = "SELECT * FROM ogloszenia JOIN kategoria ON ogloszenia. WHERE Uzytkownik=$uzytkownik";
              $ogloszenia = $baza->query($zapytanie);
              //JOIN hasla ON hasla.ID = uzytkownicy.ID
            if ($ogloszenia->num_rows > 0) {
                foreach ($ogloszenia as $ogloszenie) {
                    $id = $ogloszenie["ID"];
                    $zapytanieZdjecie = "SELECT NazwaPliku FROM zdjecia WHERE Ogloszenie=$id LIMIT 1";
                    $zdjecie = $baza->query($zapytanieZdjecie);
                    if ($zdjecie->num_rows == 1) {
                        $zdjecie = $zdjecie->fetch_assoc()['NazwaPliku'];
                    } else {
                        $zdjecie = "";
                    }
                    // print_r($ogloszenie);
                    // if ($ogloszenie['Typ']) {
                    // // echo $zdjecie;
                    // // wyswietlOgloszenie($)
                    // }
                    wyswietlOgloszenie($ogloszenie['Tytul'], $zdjecie,
                                       $ogloszenie['Tresc'], $ogloszenie['Kategoria'],
                                       $ogloszenie['DataUtworzenia'], $ogloszenie['Typ'],
                                       $ogloszenie['CenaPotrzebna'], $ogloszenie['Cena']  );
                }
                //wyswietl
            } else {
                echo "<h2>Brak ogłoszeń</h2>";
            }
            ?>
        </div>
      </div>
    </div>
    <?php require_once(FOOTER); ?>
  </body>

  </html>

<?php
function sprawdzTyp($typOferty)
{
    global $baza;
    $typy = $baza->query("SELECT * FROM typogloszenia");
    foreach ($typy as $typ) {
        if ($typOferty == $typ['ID']) {
            // $array =
        }
    }
}

function wyswietlOgloszenie($tytul, $zdjecie, $tresc, $kategoria, $data, $typ, $typInfo, $cena = 0)
{
    echo "<div class='media'>";
        echo "<div class='media-left'>";
      echo     "<a href='#'>";
                echo "<img class='media-object' src='".IMG_OGLOSZENIA.$zdjecie."' alt='$tytul'>";
          echo "</a>";
        echo "</div>";
        echo "<div class='media-body'>";
            echo "<h4 class='media-heading'>";
              echo "$tytul";
              echo "<span class='label label-info'>$typ</span>";
    if ($typInfo == 1) {
        echo "<span class='label label-info'>$cena</span>";
    }
            echo "</h4>";
            echo "<p>";
            //FIXME: dodać skracanie;
              echo "$tresc";
            echo "</p>";
            //FIXME: dodać kategorie
            echo "<div class='btn-group pull-right' role='group' aria-label='...'>";
              echo "<a href='#' class='btn btn-default'>Left</a>";
              echo "<a href='#' class='btn btn-default'>Middle</a>";
              echo "<a href='#' class='btn btn-default'><span class='glyphicon glyphicon-trash'></span></a>";
            echo "</div>";
        echo "</div>";
      echo "</div>";
}
