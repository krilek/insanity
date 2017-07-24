<?php
  require_once("config.php");
  require_once(SESJA);
  require_once(FPOMOC);
  require_once(BAZA);
  $_SERVER['REMOTE_ADDR'] = "31.42.2.220";
if (!isset($_COOKIE['miejscowosc'])) {
    if (isset($_SESSION['miejscowosc'])) {
        $_COOKIE['miejscowosc'] = $_SESSION['miejscowosc'];
    } else {
        echo namierzajKlienta($_SERVER['REMOTE_ADDR']);
    }
}

function namierzajKlienta($ip)
{
    global $baza;
    try {
        if ($infoJson = file_get_contents('http://freegeoip.net/json/'.$ip)) {
            $miejscowosc = json_decode($infoJson)->city;
            if ($miejscowosc != "" || $miejscowosc != null) {
                $miejscowosc = $baza->escape_string($miejscowosc);
                //FIXME: ANDRZEJ TO PIERDOLNIE czyt. response daje nazwy bez polskich znaków
                // SELECT * FROM miejscowosc WHERE Nazwa LIKE _utf8'%Czesto%'
                $zapytanie = "SELECT * FROM miejscowosc WHERE Nazwa='$miejscowosc'";
                echo $zapytanie;
                $wynik = $baza->query($miejscowosc);
                echo $baza->error;
                if ($wynik->num_rows == 1) {
                    $wynik = $wynik->fetch_assoc();
                    return $wynik['ID'];
                }
            }
        }
    } catch (Exception $e) {
      //TODO: log
    }
    // echo $infoJson;
}
function pokazThumbnail($dane, $kolumny = "col-xs-6 col-lg-2 col-sm-4 reset-padding")
{
    $dane['Waluta'] = "PLN";
    echo "<div class='$kolumny'>";
    echo      "<div class='thumbnail'>
                <div class='caption'>";
    echo           "<h4>".$dane['Tytul']."</h4>";
    echo            "<p>".$dane['Tresc']."</p>";
    // echo            "<p><a href='' class='label label-danger' rel='tooltip' title='Zoom'>Zoom</a>";
    // echo            "<a href='' class='label label-default' rel='tooltip' title='Download now'>Download</a></p>";
    echo        "</div>";
    echo        "<img class='img-responsive' src='".$dane['Zdjecie']."' alt='".$dane['Tytul']."'>";
    if ($dane['CenaPotrzebna'] == 1) {
        $cena = $dane['Cena']." ".$dane['Waluta'];
    } else {
        $cena = $dane['Typ'];
    }
    echo        "<div class='cena-tlo'>
                  $cena
                </div>
                <div class='cena'>
                  $cena
                </div>";
    echo      "</div>
            </div>";
}
?>

  <!doctype html>

  <html lang="pl">
    <?php require_once(HEAD);?>
    <link rel="stylesheet" href="./css/typeahead.css">

  <style>
    .thumbnail {
      /*
      "Thumbnail Caption Hover Effect"
      Snippet by MechanisM
      Copyright (c) 2013 Bootsnipp.com
      */
      position: relative;
      height: 188px;
      background: #efefef;
    }

    .thumbnail img {
      max-height: 178px;
      width: 100%;
      object-fit: cover;
      object-position: 50% 50%;
    }

    .btn-block {
      display: block;
    }

    .btn-block button {
      width: 100%;
    }


    .cena,
    .cena-tlo {
      position: absolute;
      bottom: 2px;
      right: 2px;
      padding: 2px 4px 4px 4px;
      white-space: nowrap;
      color: white;
    }

    .cena-tlo {
      background-color: rgba(92, 32, 64, 0.75);
      -webkit-filter: blur(4px);
      -moz-filter: blur(4px);
      -o-filter: blur(4px);
      -ms-filter: blur(4px);
      filter: blur(4px);
    }

    .caption {
      position: absolute;
      top: 0;
      right: 0;
      background: rgba(92, 32, 64, 0.75);
      width: 100%;
      height: 100%;
      padding: 2%;
      display: none;
      text-align: center;
      color: #fff !important;
      z-index: 2;
    }
    .caption p{
      word-wrap: break-word;
    }
    .caption h4{
      word-wrap: break-word;
    }
    @media only screen and (min-width: 768px) {
      .reset-padding {
        padding-left: 2px;
        padding-right: 2px;
      }
      .thumbnail {
        /*
      "Thumbnail Caption Hover Effect"
      Snippet by MechanisM
      Copyright (c) 2013 Bootsnipp.com
      */
        height: 158px;
      }

      .thumbnail img {
        max-height: 148px;
      }
      .btn-block {
        display: table;
      }
    }
  </style>

  <body>
    <?php require_once(NAVBAR);?>
    <div class="container">
        <?php include_once(I_BAZOWY_KAT."szukajPodpowiedzi.php");
        echo szukajDiv();
        ?>
    </div>
    
    <!--FIXME: DROPDOWN do poprawienia dodać możliwość wyszukiwania w kategorii i mieście-->
    
    <!--<div class="jumbotron ">
      XD
    </div>-->
    <div class="container ">
      <div class="row ">
        <div class="col-sm-12 ">
          <div class="page-header ">
            <h2>
              Najnowsze
            </h2>
          </div>
          <div class="row ">
            <?php
            $najnowsze = "SELECT 
                                `ogloszenia`.`ID`,
                                IF(LENGTH(`ogloszenia`.`Tytul`) > 25, CONCAT(LEFT(`ogloszenia`.`Tytul`, 25), '...'), `ogloszenia`.`Tytul`) AS Tytul,
                                IF(LENGTH(`ogloszenia`.`Tresc`) > 50, CONCAT(LEFT(`ogloszenia`.`Tresc`, 50), '...'), `ogloszenia`.`Tresc`) AS Tresc,
                                REPLACE(CAST(`ogloszenia`.`Cena` AS CHAR), '.', ',') as Cena,
                                `kategorie`.`Nazwa` as Kategoria, `typogloszenia`.`Nazwa` as Typ,
                                `typogloszenia`.`CenaPotrzebna`, `zdjecia`.`NazwaPliku`, `ogloszenia`.`DataUtworzenia`
                                FROM ogloszenia 
                                  JOIN kategorie ON `kategorie`.`ID` = `ogloszenia`.`Kategoria` 
                                  JOIN typogloszenia ON `typogloszenia`.`ID` = `ogloszenia`.`Typ` 
                                  LEFT JOIN (SELECT * FROM `zdjecia` GROUP BY `zdjecia`.`Ogloszenie`) AS `zdjecia` ON `ogloszenia`.`ID` = `zdjecia`.`Ogloszenie`
                          ORDER BY `ogloszenia`.`DataUtworzenia` DESC LIMIT 6";
            if ($wynik = $baza->query($najnowsze)) {
              //for
                foreach ($wynik as $ogloszenie) {
                    if (file_exists(I_IMG_OGLOSZENIA.$ogloszenie['NazwaPliku'])) {
                        $ogloszenie['Zdjecie'] = IMG_OGLOSZENIA.$ogloszenie['NazwaPliku'];
                    } else {
                        $ogloszenie['Zdjecie'] = IMG_KAT."brakZdjecia.png";
                    }

                        pokazThumbnail($ogloszenie);
                }
            } else {
                echo "Brak ogłoszeń";
            }
            

            ?>
          </div>
        </div>
      </div>
      <div class="row ">
        <div class="col-sm-12 ">
          <div class="page-header ">
            <h2>
              Najpopularniejsze
            </h2>
          </div>
          <div class="row ">
            <?php
            $najpopularniejsze = "SELECT 
                                `ogloszenia`.`ID`,
                                IF(LENGTH(`ogloszenia`.`Tytul`) > 25, CONCAT(LEFT(`ogloszenia`.`Tytul`, 25), '...'), `ogloszenia`.`Tytul`) AS Tytul,
                                IF(LENGTH(`ogloszenia`.`Tresc`) > 50, CONCAT(LEFT(`ogloszenia`.`Tresc`, 50), '...'), `ogloszenia`.`Tresc`) AS Tresc,
                                REPLACE(CAST(`ogloszenia`.`Cena` AS CHAR), '.', ',') as Cena,
                                `kategorie`.`Nazwa` as Kategoria, `typogloszenia`.`Nazwa` as Typ,
                                `typogloszenia`.`CenaPotrzebna`, `zdjecia`.`NazwaPliku`, `ogloszenia`.`DataUtworzenia`
                                FROM ogloszenia 
                                  JOIN kategorie ON `kategorie`.`ID` = `ogloszenia`.`Kategoria` 
                                  JOIN typogloszenia ON `typogloszenia`.`ID` = `ogloszenia`.`Typ` 
                                  LEFT JOIN (SELECT * FROM `zdjecia` GROUP BY `zdjecia`.`Ogloszenie`) AS `zdjecia` ON `ogloszenia`.`ID` = `zdjecia`.`Ogloszenie`
                          ORDER BY `ogloszenia`.`Wyswietlenia` DESC LIMIT 6";
            if ($wynik = $baza->query($najpopularniejsze)) {
              //for
                foreach ($wynik as $ogloszenie) {
                    if (file_exists(I_IMG_OGLOSZENIA.$ogloszenie['NazwaPliku'])) {
                        $ogloszenie['Zdjecie'] = IMG_OGLOSZENIA.$ogloszenie['NazwaPliku'];
                    } else {
                        $ogloszenie['Zdjecie'] = IMG_KAT."brakZdjecia.png";
                    }

                        pokazThumbnail($ogloszenie);
                }
            } else {
                echo "Brak ogłoszeń";
            }
            

            ?>
          </div>
        </div>
      </div>
      <div class="row ">
        <div class="col-sm-12 ">
          <div class="page-header ">
            <h2>
              W twoim regionie
            </h2>
          </div>
          <div class="row ">
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      <div class="row ">
        <div class="col-sm-12 ">
          <div class="page-header ">
            <h2>
              Ostatnio przeglądane
            </h2>
          </div>
          <div class="row ">
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
    <?php require_once(FOOTER); ?>
    <script src="./js/typeahead.bundle.min.js"></script>
    <script>
      $(document).ready(function () {
        $("[rel='tooltip' ] ").tooltip();

        $('.thumbnail').hover(
          function () {
            $(this).find('.caption').fadeIn(250)
          },
          function () {
            $(this).find('.caption').fadeOut(205)
          }
        );
      });
// constructs the suggestion engine
      
      var ogloszenia = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: <?php echo "'".BAZOWY_KAT."szukajPodpowiedzi.php?tabela=ogloszenia&q=%QUERY',";?>
          wildcard: '%QUERY',
          cache: true
        }
      });
      $('#wyszukiwarka').typeahead({
        hint: true,
        highlight: true,
        minLength: 2
      }, {
        name: 'ogloszenia',
        source: ogloszenia
      });
      
      var miejscowosc = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: <?php echo "'".BAZOWY_KAT."szukajPodpowiedzi.php?tabela=miejscowosc&q=%MIEJSCOWOSC',";?>
          wildcard: '%MIEJSCOWOSC',
          cache: true,
          filter: function(resp) {
            var dataset = resp;
            console.log(dataset); // debug the response here

            // do some filtering if needed with the response          

            return dataset;
        }
        }
      });
      $('#wyszukiwarka-miejscowosc').typeahead({
        hint: true,
        highlight: true,
        minLength: 2
      }, {
        name: 'miejscowosc',
        source: miejscowosc
      });


      // https://twitter.github.io/typeahead.js/examples/#multiple-datasets
      //https://stackoverflow.com/questions/23510474/typeahead-js-with-clickable-links
      // https://stackoverflow.com/questions/30118217/how-to-get-output-from-php-to-typeahead
      // https://github.com/twitter/typeahead.js/blob/master/doc/bloodhound.md#prefetch
    </script>
  </body>

  </html>
