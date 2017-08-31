<?php
require_once("../config.php");
  require_once(SESJA);
  require_once(FPOMOC);
  require_once(BAZA);
?>

  <!doctype html>
  <html lang="pl">
    <?php require_once(HEAD);?>
  <style>
    #ludzie div {
      min-height: 200px;
      overflow-y: scroll;
      height: 20vh;
    }

    #ludzie div a {
      cursor: pointer;
    }

    @media screen and (min-width: 768px) {
      #ludzie div {
        height: 60vh;
      }
      #ludzie {
        padding-right: 0px;
      }
      #chat-col {
        padding-left: 0px;
      }
    }

    #chat {
      position: relative;
      min-height: 400px;
      height: 60vh;
    }

    #chat .input-group {
      position: absolute;
      bottom: 0px;
    }

    .panel-body {
      position: absolute;
      bottom: 39px;
      top: 42px;
      /*max-height: calc(60vh - 80px);*/
      overflow-y: scroll;
      overflow-x: hidden;
    }

    .media-right img {
      width: 100%;
      margin-bottom: 2px;
    }

    .media-left img {
      width: 100%;
      margin-bottom: 2px;
    }

    .lewo {
      text-align: left;
    }

    .prawo {
      text-align: right;
    }
    /*#chat .panel{
    height: 100%;
  }*/
    /*.przewijalne{
    height: 100%;
    overflow-y: scroll;
  }
  .przewijalne li{
    margin-right: 2px;
  }*/
  </style>

  <body>
    <?php require_once(NAVBAR);?>
    <div class="container">
      <div class="page-header">
        <h1>Wiadomości</h1>
      </div>
      <div class="row">
        <div class="col-sm-4" id="ludzie">
          <div class="list-group">
            <?php
              $zapytanie = "SELECT czat_rozmowa.ID, uzytkownik1.Login as Login1, czat_rozmowa.IDUzytkownik1 as ID1, uzytkownik2.Login as Login2, czat_rozmowa.IDUzytkownik2 as ID2
                              FROM czat_rozmowa 
                              JOIN uzytkownicy AS uzytkownik1 ON `uzytkownik1`.`ID` = `czat_rozmowa`.`IDUzytkownik1` 
                              JOIN uzytkownicy AS uzytkownik2 ON `uzytkownik2`.`ID` = `czat_rozmowa`.`IDUzytkownik2` 
                            WHERE IDUzytkownik1='".$_SESSION['idUzytkownika']."' OR IDUzytkownik2='".$_SESSION['idUzytkownika']."'";
            if ($rozmowy = $baza->query($zapytanie)) {
                if ($rozmowy->num_rows > 0) {
                    //Wypisz listę użytkowników
                    foreach ($rozmowy as $rozmowa) {
                        // print_r($rozmowa);
                        echo "<a class='list-group-item' onclick='wybierzRozmowe(".$rozmowa['ID'].")'>".($rozmowa['ID1'] == $_SESSION['idUzytkownika'] ? $rozmowa['Login2'] : $rozmowa['Login1'])."</a>";
                    }
                } else {
                    echo "Brak rozmówców";
                }
            } else {
                echo $baza->error;
            }
            ?>
              <!--<li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus<span class="badge">321</span></li>
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus<span class="badge">321</span></li>
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus<span class="badge">321</span></li>
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus<span class="badge">321</span></li>
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus<span class="badge">321</span></li>-->
          </div>
        </div>
        <div class="col-sm-8" id="chat-col">
          <div id="chat">
            <div class="panel panel-default">
              <div class="panel-heading">Rozmówca</div>
              <div class="panel-body" id="wiadomosciLista">
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
                    </a>
                    <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
                  </div>
                  <div class="media-body">
                    <p>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum
                      in vulputate at, tempus viverra turpis.
                    </p>
                  </div>
                </div>
                <div class="media">
                  <div class="media-body">
                    <p>
                      TRESC
                    </p>
                  </div>
                  <div class="media-right">
                    <a href="#">
                      <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
                    </a>
                    <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
                  </div>
                </div>
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
                    </a>
                    <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
                  </div>
                  <div class="media-body">
                    <p>
                      Tresc
                    </p>
                  </div>
                </div>
                <div class="media">
                  <div class="media-body">
                    <p>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum
                      in vulputate at, tempus viverra turpis.
                    </p>
                  </div>
                  <div class="media-right">
                    <a href="#">
                      <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
                    </a>
                    <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
                  </div>
                </div>
                <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
                    </a>
                    <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
                  </div>
                  <div class="media-body">
                    <p>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum
                      in vulputate at, tempus viverra turpis.
                    </p>
                  </div>
                </div>
                <div class="media">
                  <div class="media-body">
                    <p>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum
                      in vulputate at, tempus viverra turpis.
                    </p>
                  </div>
                  <div class="media-right">
                    <a href="#">
                      <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
                    </a>
                    <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
                  </div>
                </div>
              </div>
            </div>
            <!-- INPUT -->
            <form id="inputChatu">
              <div class="input-group">
                <input type="text" id="input-wiadomosc" class="form-control" aria-label="...">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
                  <button type="submit" id="wyslij-btn" class="btn btn-default">Wyślij</button>
                  <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php require_once(FOOTER); ?>
    <script>
        <?php
        echo "var idUzytkownika = ".$_SESSION['idUzytkownika'].";";
        ?>
      var idRozmowy = -1;
      var ostatniaWiadomosc = 1;
      var licznikOdswiezania = undefined;
      $(document).ready(function () {
        $("#inputChatu").on("submit", function (e) {
          e.preventDefault();
          wyslijWiadomosc($("#input-wiadomosc"), idUzytkownika, idRozmowy);
        });
      })

      function wyslijWiadomosc(input, nadawcaWiadomosci, rozm) {
        trescWiadomosci = input.val();
        if (trescWiadomosci.length > 0) {
          var dane = {
            tryb: "wiadomosc",
            wiadomosc: trescWiadomosci,
            nadawca: nadawcaWiadomosci,
            rozmowa: rozm
          };
          $.post("czat.php", dane,
            function (data, textStatus, jqXHR) {
              console.log(data);
              if (data.kod == 200) {
                input.val("")
                window.clearInterval(licznikOdswiezania);
                odswiezWiadomosci(idRozmowy, ostatniaWiadomosc);
              }
              //TODO: usuniecie timera stworzenie nowego
              //wypisanie nowych wiadomosci po wysłaniu

            }
          );
        }
      }

      function wybierzRozmowe(id) {
        idRozmowy = id;
        var dane = {
          tryb: "pobierzWiadomosci",
          idRozmowy: id
        }
        $.post("czat.php", dane,
          function (data, textStatus, jqXHR) {
            if (data.kod == 200) {
              console.log(data);
              ostatniaWiadomosc = data.ostatniaWiadomosc;
              wypiszWiadomosci(data.wiadomosci, data.iloscWiadomosci, undefined, "skok");
            }
          }
        );
      }

      function wypiszWiadomosci(wiadomosci, ilosc, dopisywanie, scroll) {

        var divWiadomosci = $("#wiadomosciLista");
        if (dopisywanie != true) {
          divWiadomosci.html("");
        }
        //TODO: ProgressBar?
        wiadomosci.forEach(function (element, idx) {
          var strona;
          if (idUzytkownika == element.Nadawca) {
            strona = 'p';
          } else {
            strona = 'l';
          }
          var data = new Date(element.Data);
          wypiszWiadomosc(divWiadomosci, element.Tresc, data, strona, "");
        });
        if (scroll != "skok") {
          divWiadomosci.animate({
            scrollTop: divWiadomosci[0].scrollHeight
          }, "slow");

        } else {
          divWiadomosci[0].scrollTop = divWiadomosci[0].scrollHeight;
        }
        if (licznikOdswiezania == undefined) {
          licznikOdswiezania = setInterval(function () {
            odswiezWiadomosci(idRozmowy, ostatniaWiadomosc);
          }, 2000);
        }
      }

      function odswiezWiadomosci(idRozmowy, ostatniaWiadomosc) {
        var dane = {
          tryb: "odswiezRozmowe",
          idRozmowy: idRozmowy,
          idOstatniejWiadomosci: ostatniaWiadomosc
        }
        $.post("czat.php", dane, function (data, textStatus, jqXHR) {
          if (data.kod == 200) {
            console.log(data);
            window.ostatniaWiadomosc = data.ostatniaWiadomosc;
            wypiszWiadomosci(data.wiadomosci, data.iloscWiadomosci, true);
          }
        });
      }

      function wypiszWiadomosc(ojciec, trescWiadomosci, dataWiadomosci, stronaWiadomosci, zdjecieNadawcy) {
        var data = String(dataWiadomosci.getDate()) + "." + String(dataWiadomosci.getMonth() + 1) + "." + String(
          dataWiadomosci.getFullYear())
        var godziny = String(dataWiadomosci.getHours())
        var minuty = String((dataWiadomosci.getMinutes() < 10 ? "0" + dataWiadomosci.getMinutes() : dataWiadomosci.getMinutes()));
        var czas = godziny + ":" + minuty;
        var mediaBody = "<div class='media-body'><p class='" + (stronaWiadomosci == 'l' ? 'lewo' : 'prawo') + "'>" +
          trescWiadomosci + "</p></div>";
        var mediaInfo =
          "<div class='" + (stronaWiadomosci == 'l' ? 'media-left' : 'media-right') +
          "'><a href='#'><img class='media-object img-circle' src='" + "http://placehold.it/32x32" +
          "' alt='...'></a><span class='label label-info' data-toggle='tooltip' data-placement='top' title='" + data +
          "'>" + czas + "</span></div>";
        var media = '<div class="media">';
        if (stronaWiadomosci == 'l') {
          media += mediaInfo;
          media += mediaBody;
        } else {
          media += mediaBody;
          media += mediaInfo;
        }
        media += "</div>";
        // console.log(media);
        ojciec.append(media);
      }

      // <div class="media">
      //   <div class="media-body">
      //     <p>
      //       TRESC
      //     </p>
      //   </div>
      //   <div class="media-right">
      //     <a href="#">
      //                       <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
      //                     </a>
      //     <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
      //   </div>
      // </div>
      // <div class="media">
      //   <div class="media-left">
      //     <a href="#">
      //                       <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
      //                     </a>
      //     <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
      //   </div>
      //   <div class="media-body">
      //     <p>
      //       Tresc
      //     </p>
      //   </div>
      // </div>
    </script>
  </body>

  </html>
