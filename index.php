<?php
  require_once("config.php");
  require_once(SESJA);
  require_once(FPOMOC);
  require_once(BAZA);
  require_once(I_OGLOSZENIA_KAT."ogloszenieClass.php");
  // $_SERVER['REMOTE_ADDR'] = "31.42.2.220";
  sprawdzLokalizacje();
  //FIXME: update miejscowosci musi byc wczesniej, jakiś problem po wylogowaniu i zalogowaniu?

function pokazThumbnail($dane, $obiekt = false, $kolumny = "col-lg-2 col-sm-4 reset-padding")
{
    if ($obiekt) {
        $arr['Tytul'] = $dane->tytul;
        $arr['Tresc'] = $dane->tresc;
        $arr['ID'] = $dane->id;
        if ($dane->saZdjecia) {
            $arr['Zdjecie'] = IMG_OGLOSZENIA.$dane->zdjecia[0];
        } else {
            $arr['Zdjecie'] = IMG_KAT."brakZdjecia.png";
        }
        $arr['CenaPotrzebna'] = $dane->cenaPotrzebna;
        $arr['Cena'] = $dane->cena;
        $arr['Typ'] = $dane->typOgloszenia;
        $dane = $arr;
    }
    $dane['Waluta'] = "PLN";
    echo "<div class='$kolumny'>";
    echo      "<div class='thumbnail'>
                <div class='caption'>";
    echo           "<h4>".$dane['Tytul']."</h4>";
    echo            "<p>".$dane['Tresc']."</p>";
    echo            "<p><a href='".OGLOSZENIA_KAT."ogloszenie.php?id=".$dane['ID']."' class='label label-danger' rel='tooltip' title='Zobacz'>Zobacz</a></p>";
    // echo            "<a href='' class='label label-default' rel='tooltip' title='Download now'>Download</a></p>";
    echo        "</div>";
    echo        "<img class='img-responsive' src='".(isset($dane['Zdjecie']) ? IMG_OGLOSZENIA.$dane['Zdjecie'] : IMG_KAT."brakZdjecia.png"). "' alt='".$dane['Tytul']."'>";
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
    body{
      padding-top: 0px;
    }
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

    .popover-content {
      /*max-width: 100%;*/
      margin-left: 10px;
      margin-right: 10px;
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

    #wyszukiwarka-miejscowosc .tt-menu {
      max-height: 150px;
      overflow-y: auto;
    }

    .caption p {
      word-wrap: break-word;
    }

    .caption h4 {
      word-wrap: break-word;
    }

    @media only screen and (min-width: 768px) {
      .reset-padding {
        padding-left: 2px;
        padding-right: 2px;
      }
      .popover {
        width: 276px;
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
    <div class="container">
            <?php
            $najnowsze = "SELECT 
                                `ogloszenia`.`ID`,
                                IF(LENGTH(`ogloszenia`.`Tytul`) > 25, CONCAT(LEFT(`ogloszenia`.`Tytul`, 25), '...'), `ogloszenia`.`Tytul`) AS Tytul,
                                IF(LENGTH(`ogloszenia`.`Tresc`) > 50, CONCAT(LEFT(`ogloszenia`.`Tresc`, 50), '...'), `ogloszenia`.`Tresc`) AS Tresc,
                                REPLACE(CAST(`ogloszenia`.`Cena` AS CHAR), '.', ',') as Cena,
                                `kategoria`.`Nazwa` as Kategoria, `typogloszenia`.`Nazwa` as Typ,
                                `typogloszenia`.`CenaPotrzebna`, `zdjecia`.`NazwaPliku`, `ogloszenia`.`DataUtworzenia`
                                FROM ogloszenia 
                                  JOIN kategoria ON `kategoria`.`ID` = `ogloszenia`.`Kategoria` 
                                  JOIN typogloszenia ON `typogloszenia`.`ID` = `ogloszenia`.`Typ` 
                                  LEFT JOIN (SELECT * FROM `zdjecia` GROUP BY `zdjecia`.`Ogloszenie`) AS `zdjecia` ON `ogloszenia`.`ID` = `zdjecia`.`Ogloszenie`
                          ORDER BY `ogloszenia`.`DataUtworzenia` DESC LIMIT 6";
            if ($wynik = $baza->query($najnowsze)) {
                if ($wynik->num_rows > 0) {
                    echo '<div class="row">
                          <div class="col-sm-12">
                            <div class="page-header">
                              <h2>
                                Najnowsze
                              </h2>
                            </div>
                            <div class="row">';
                    foreach ($wynik as $ogloszenie) {
                        if (file_exists(I_IMG_OGLOSZENIA.$ogloszenie['NazwaPliku'])) {
                            $ogloszenie['Zdjecie'] = $ogloszenie['NazwaPliku'];
                        }

                        pokazThumbnail($ogloszenie);
                    }
                    echo '
                      </div>
                    </div>
                  </div>';
                }
            }
            

            ?>
      
            <?php
            $najpopularniejsze = "SELECT 
                                `ogloszenia`.`ID`,
                                IF(LENGTH(`ogloszenia`.`Tytul`) > 25, CONCAT(LEFT(`ogloszenia`.`Tytul`, 25), '...'), `ogloszenia`.`Tytul`) AS Tytul,
                                IF(LENGTH(`ogloszenia`.`Tresc`) > 50, CONCAT(LEFT(`ogloszenia`.`Tresc`, 50), '...'), `ogloszenia`.`Tresc`) AS Tresc,
                                REPLACE(CAST(`ogloszenia`.`Cena` AS CHAR), '.', ',') as Cena,
                                `kategoria`.`Nazwa` as Kategoria, `typogloszenia`.`Nazwa` as Typ,
                                `typogloszenia`.`CenaPotrzebna`, `zdjecia`.`NazwaPliku`, `ogloszenia`.`DataUtworzenia`
                                FROM ogloszenia 
                                  JOIN kategoria ON `kategoria`.`ID` = `ogloszenia`.`Kategoria` 
                                  JOIN typogloszenia ON `typogloszenia`.`ID` = `ogloszenia`.`Typ` 
                                  LEFT JOIN (SELECT * FROM `zdjecia` GROUP BY `zdjecia`.`Ogloszenie`) AS `zdjecia` ON `ogloszenia`.`ID` = `zdjecia`.`Ogloszenie`
                          ORDER BY `ogloszenia`.`Wyswietlenia` DESC LIMIT 6";
            if ($wynik = $baza->query($najpopularniejsze)) {
                if ($wynik->num_rows > 0) {
                    echo '
                      <div class="row">
                      <div class="col-sm-12">
                        <div class="page-header">
                          <h2>
                            Najpopularniejsze
                          </h2>
                        </div>
                        <div class="row">';
                    foreach ($wynik as $ogloszenie) {
                        if (file_exists(I_IMG_OGLOSZENIA.$ogloszenie['NazwaPliku'])) {
                            $ogloszenie['Zdjecie'] = $ogloszenie['NazwaPliku'];
                        }
                        pokazThumbnail($ogloszenie);
                    }
                    echo '
                        </div>
                      </div>
                    </div>';
                }
            }
            

            ?>
            <?php
            if (isset($_COOKIE['miejscowosc']) && $_COOKIE['miejscowosc'] > 0) {
                $miejscowosc = $baza->escape_string($_COOKIE['miejscowosc']);
                $wRegionie = "SELECT
                                `ogloszenia`.`ID`,
                                IF(LENGTH(`ogloszenia`.`Tytul`) > 25, CONCAT(LEFT(`ogloszenia`.`Tytul`, 25), '...'), `ogloszenia`.`Tytul`) AS Tytul,
                                IF(LENGTH(`ogloszenia`.`Tresc`) > 50, CONCAT(LEFT(`ogloszenia`.`Tresc`, 50), '...'), `ogloszenia`.`Tresc`) AS Tresc,
                                REPLACE(CAST(`ogloszenia`.`Cena` AS CHAR), '.', ',') as Cena,
                                `kategoria`.`Nazwa` as Kategoria, `typogloszenia`.`Nazwa` as Typ,
                                `typogloszenia`.`CenaPotrzebna`, `zdjecia`.`NazwaPliku`, `ogloszenia`.`DataUtworzenia`,
                                `uzytkownicy`.`Miejscowosc` as Miejscowosc
                                FROM ogloszenia
                                  JOIN kategoria ON `kategoria`.`ID` = `ogloszenia`.`Kategoria`
                                  JOIN typogloszenia ON `typogloszenia`.`ID` = `ogloszenia`.`Typ`
                                  JOIN uzytkownicy ON `uzytkownicy`.`ID` = `ogloszenia`.`Uzytkownik`
                                  LEFT JOIN (SELECT * FROM `zdjecia` GROUP BY `zdjecia`.`Ogloszenie`) AS `zdjecia` ON `ogloszenia`.`ID` = `zdjecia`.`Ogloszenie`
                          WHERE `uzytkownicy`.`Miejscowosc` = $miejscowosc
                          ORDER BY `ogloszenia`.`Wyswietlenia` DESC LIMIT 6";
                if ($wynik = $baza->query($wRegionie)) {
                    if ($wynik->num_rows > 0) {
                        echo '
                    <div class="row ">
                      <div class="col-sm-12 ">
                        <div class="page-header ">
                          <h2>
                            W twoim regionie
                          </h2>
                        </div>
                        <div class="row ">';
                        foreach ($wynik as $ogloszenie) {
                            if (file_exists(I_IMG_OGLOSZENIA.$ogloszenie['NazwaPliku'])) {
                                $ogloszenie['Zdjecie'] = $ogloszenie['NazwaPliku'];
                            }
                            pokazThumbnail($ogloszenie);
                        }
                    }
                }
            }
      
        ?>

          </div>
        </div>
      </div>
        <?php
        if (isset($_SESSION['ostatnieOgloszenia']) && count($_SESSION['ostatnieOgloszenia'] ) > 0) {
            echo '
        <div class="row ">
          <div class="col-sm-12 ">
            <div class="page-header ">
              <h2>
                Ostatnio przeglądane
              </h2>
            </div>
            <div class="row ">';
            for ($i=count($_SESSION['ostatnieOgloszenia'])-1; $i>=0; $i--) {
                pokazThumbnail($_SESSION['ostatnieOgloszenia'][$i]);
            }
            echo '
            </div>
          </div>
        </div>';
        }
        ?>
    </div>
    <?php require_once(FOOTER); ?>
    <script src="./js/typeahead.bundle.min.js"></script>
    <script>
      var miejscowoscInput = "";
      var kategoriaInput = "";
      var ogloszenia = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: <?php echo "'".BAZOWY_KAT."szukajPodpowiedzi.php?tabela=ogloszenia&q=%QUERY',";?>
          wildcard: '%QUERY',
          cache: true
        }
      });


      var miejscowosc = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: <?php echo "'".BAZOWY_KAT."szukajPodpowiedzi.php?tabela=miejscowosc&q=%MIEJSCOWOSC',";?>
          wildcard: '%MIEJSCOWOSC',
          cache: true
        }
      });


      var kategoria = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: <?php echo "'".BAZOWY_KAT."szukajPodpowiedzi.php?tabela=kategoria&q=%KATEGORIA',";?>
          wildcard: '%KATEGORIA',
          cache: true,
          filter: function (data) {
            // filter the returned data
            console.log(data);
            return data;
          }
        }
      });

      function sugestieDodatkowe() {

        $('.popover #wyszukiwarka-miejscowosc .typeahead').typeahead({
          hint: true,
          highlight: true,
          minLength: 3
        }, {
          name: 'miejscowosc',
          limit: Infinity,
          source: miejscowosc
        });
        $('.popover #wyszukiwarka-kategoria .typeahead').typeahead({
          hint: true,
          highlight: true,
          minLength: 1
        }, {
          name: 'kategoria',
          limit: Infinity,
          source: kategoria
        });
        //Przy zamknięciu i otwarciu usuwany jest element dlatego to:

        $('#wyszukiwarka-miejscowosc input.typeahead').typeahead('val', miejscowoscInput);
        $('#wyszukiwarka-kategoria input.typeahead').typeahead('val', kategoriaInput);
      }
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
        $('#wyszukiwarka .typeahead').typeahead({
          hint: true,
          highlight: true,
          minLength: 2
        }, {
          name: 'ogloszenia',
          source: ogloszenia
        });
        $('#dodatkowe-opcje').popover()
          .on('inserted.bs.popover', sugestieDodatkowe)
          .on('hide.bs.popover', function () {
            // console.log("Zamknięte: "+$('.popover #wyszukiwarka-miejscowosc').typeahead('val'));
            // console.log("Zamknięte: ",$('.popover #wyszukiwarka-miejscowosc .typeahead'));
            // console.log($('#wyszukiwarka-miejscowosc input.typeahead.tt-input'));
            if ($('#wyszukiwarka-miejscowosc input.typeahead.tt-input').typeahead('val') != "") {
              miejscowoscInput = $('#wyszukiwarka-miejscowosc input.typeahead.tt-input').typeahead('val');
            }
            if ($('#wyszukiwarka-kategoria input.typeahead.tt-input').typeahead('val') != "") {
              kategoriaInput = $('#wyszukiwarka-kategoria input.typeahead.tt-input').typeahead('val');
            }
          });
      });
      //FIXME: onchange event w typeahead żeby wyciągać wartość i lecimy może zadziała (zamknięcie  i klikanie powoduje usunięcie danych)
      // http://getbootstrap.com/javascript/#popovers-events
      // https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md#jquerytypeaheadval
      // $(document).on('click', function (e) {
      //   $('[data-toggle="popover"],[data-original-title]').each(function () {
      //     if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length ===
      //       0) {
      //       $(this).popover('hide').data('bs.popover').inState.click = false
      //     }

      //   });
      // });


      // https://twitter.github.io/typeahead.js/examples/#multiple-datasets
      //https://stackoverflow.com/questions/23510474/typeahead-js-with-clickable-links
      // https://stackoverflow.com/questions/30118217/how-to-get-output-from-php-to-typeahead
      // https://github.com/twitter/typeahead.js/blob/master/doc/bloodhound.md#prefetch
      // https://stackoverflow.com/questions/24560108/typeahead-v0-10-2-bloodhound-working-with-nested-json-objects
      //TODO: Do szybszego wyszukiwania w szukaniu ofert 
      // https://stackoverflow.com/questions/12389948/twitter-bootstrap-typeahead-id-label 
      // http://tatiyants.com/how-to-use-json-objects-with-twitter-bootstrap-typeahead/
    </script>
  </body>

  </html>
