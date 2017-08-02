<?php
  require_once("../config.php");
  require_once(SESJA);
  require_once(I_BAZOWY_KAT."jednostkiTerytorialne.php");
  //FIXME: poprawić head tak żeby znaczniki head były na każdej stronie a includy wewnątrz nie bug ale boli
?>
  <!doctype html>

  <html lang="pl">

  <?php require_once(HEAD); ?>
  <style>
    .swipe {
      overflow: hidden;
      visibility: hidden;
      position: relative;
    }

    .swipe-wrap {
      overflow: hidden;
      position: relative;
    }

    .swipe-wrap>div {
      float: left;
      width: 100%;
      position: relative;
    }

    .swipe-wrap .col-xs-12 {
      padding-left: 0px;
      padding-right: 0px;
    }

    #lokalizacja .row {
      margin-left: 0px;
      margin-right: 0px;
    }

    .pager {
      margin-top: 0px;
      margin-bottom: 6px;
    }

    #powiat,
    #miejscowosc,
    #dzielnica {
      max-height: 600px;
      overflow-y: scroll;
    }

    #finish {
      margin-right: 15px;
      margin-top: 5px;
    }

    .pager a:hover {
      color: #772953;
      cursor: pointer;
    }
  </style>

  <body>
    <?php require_once(NAVBAR); ?>
    <div class="container">
      <div class="col-sm-12">
        <form class="form-horizontal" method="post" action="<?php echo UZYTKOWNIK_KAT.'rej.php';?>">
          <h3>
            <legend>Rejestracja</legend>
          </h3>
          <div class="row">
            <div class="col-sm-6">
              <fieldset>
                <div class="form-group">
                  <label for="email" class="col-lg-3 control-label">Email</label>
                  <div class="col-lg-9">
                    <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="login" class="col-lg-3 control-label">Login</label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control" name="login" id="login" placeholder="Login">

                  </div>
                </div>
                <div class="form-group">
                  <span class="col-lg-3"></span>
                  <!--TODO: przerobić to na tooltip? modal? popover?-->
                  <!--TODO: Zrobić event onchange-->
                  <div class="col-lg-9" id="ajax-info">
                  </div>
                </div>
                <div class="form-group">
                  <label for="haslo" class="col-lg-3 control-label">Hasło</label>
                  <div class="col-lg-9">
                    <input type="password" class="form-control" name="haslo" id="haslo" placeholder="Hasło">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">
                    <input type="password" class="form-control" name="haslo2" id="haslo2" placeholder="Wprowadź ponownie hasło">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Imie</label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control" name="imie" placeholder="Imie">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Nazwisko</label>
                  <div class="col-lg-9">
                    <input type="text" class="form-control" name="nazwisko" placeholder="Nazwisko">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Płeć</label>
                  <div class="col-lg-9">
                    <div class="radio">
                      <label>
                        <input type="radio" name="plec" id="plecKobieta" value="K" checked>
                        Kobieta
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="plec" id="plecMezczyzna" value="M">
                        Mężczyzna
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="plec" id="plecInna" value="I">
                        Inna
                      </label>
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="col-sm-6">
              <div id="lokalizacja" class="swipe">
                <div class="swipe-wrap">
                  <div class="col-xs-12">
                    <label class="control-label">Wojewodztwo</label>
                    <div class="row" id="wojewodztwo">
                      <?php
                          wypiszWojewodztwa(2);
                        
                        ?>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <label class=" control-label">Powiat</label>
                    <ul class="pager">
                      <li class="previous"><a onclick="lokalizacja.prev()">&larr; Wstecz</a></li>
                    </ul>
                    <div class="row" id="powiat">
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <label class=" control-label">Miejscowosc / Dzielnica</label>
                    <ul class="pager">
                      <li class="previous"><a onclick="lokalizacja.prev()">&larr; Wstecz</a></li>
                    </ul>
                    <div class="row" id="miejscowosc">
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <label class=" control-label">Dzielnica</label>
                    <ul class="pager">
                      <li class="previous"><a onclick="lokalizacja.prev()">&larr; Wstecz</a></li>
                    </ul>
                    <div class="row" id="dzielnica">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group pull-right" id="finish">
                <input type="hidden" name="tryb" value="rejestracja">
                <input type="hidden" id="miejscowoscInput" name="miejscowosc">
                <button type="reset" class="btn btn-default">Resetuj</button>
                <button type="submit" class="btn btn-primary">Wyślij</button>
              </div>

            </div>
          </div>
        </form>
      </div>
    </div>
    <?php
    require_once(FOOTER);
    echo "<script src='".JS_KAT.'swipe.js'."?x=".time()."'></script>";
    echo '<script src="'.JS_KAT.'rejestracja.js?x='.time().'"></script>';
    ?>
      <script>
        window.lokalizacja = new Swipe(document.getElementById('lokalizacja'), {
          disableTouch: true,
          continuous: false
        });
        nrListy = lokalizacja.getPos();
        var wojewodztwo = null;
        var powiat = null;
        var miejscowosc = null;
        var dzielnica = null;
        var ostatniElement
        var kolejnosc = ['powiat', 'miejscowosc', 'dzielnica'];

        function wybor(dane, element) {
          nrListy = lokalizacja.getPos();
          if (dane.wojewodztwo) {
            wojewodztwo = Number(dane.wojewodztwo);
            dane.wojewodztwo = Number(dane.wojewodztwo);
          }
          if (dane.NrPowiatu) {
            powiat = Number(dane.NrPowiatu);
            dane.NrPowiatu = Number(dane.NrPowiatu);
          }
          if (dane.ID && dane.ID2) {
            $("#miejscowoscInput").val(dane.ID);
            if (ostatniElement) {
              $(ostatniElement).removeClass("active");
            }
            $(element).addClass("active");
            ostatniElement = element;
            // console.log(dane.Nazwa);
          }
          // console.log(dane);
          var cel = $(element).attr('target');
          var url = <?php echo '"'.BAZOWY_KAT.'jednostkiTerytorialne.php?tabela='.'"'?> + cel;
          // console.log(url);
          $.get(url, dane,
            function (data, textStatus, jqXHR) {
              console.log(data);
              if (nrListy + 1 < kolejnosc.length) {
                wypiszJednostki(data, cel, kolejnosc[nrListy + 1]);
                lokalizacja.next();
              }
            }
          );
        }

        function wypiszJednostki(jednostki, cel, nastepnyCel) {
          console.log(cel, nastepnyCel);
          cel = $("#" + cel);
          zawartosc = "<div class='col-xs-12'>";
          // <a onclick="wybor({wojewodztwo:2}, this)" target="powiat" class="btn btn-info">dolnośląskie</a><a onclick="wybor({wojewodztwo:4}, this)"
          //       target="powiat" class="btn btn-info">kujawsko-pomorskie</a> </div>
          // </div>
          jednostki.forEach(function (element) {
            element.wojewodztwo = wojewodztwo;
            // console.log(element);
            zawartosc += "<div class='btn-group btn-group-justified'><a onclick='" + "wybor(" + JSON.stringify(
                element) + ", this)" +
              "' target='" + nastepnyCel + "' class='btn btn-info'>" + element.Nazwa + "</a></div>";
          });
          zawartosc += "</div>";
          cel.html(zawartosc);
        }
      </script>
  </body>

  </html>