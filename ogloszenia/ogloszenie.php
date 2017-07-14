<?php
  require_once("../config.php");
  require_once(SESJA);
  require_once(BAZA);
  $baza->query
if (isset($_SESSION['idUzytkownika'])) {
    $admin = true;
}
?>

  <!doctype html>
  <html lang="pl">
    <?php require_once(HEAD);?>
  <link rel="stylesheet" href="ogloszenie.css">

  <body>
    <?php require_once(NAVBAR);?>
    <div class="jumbotron hidden-xs" id="tlo">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12" id="zdjecia-row">
          <div id="glowne-zdjecie" class="hidden-xs">
            <a class="thumbnail">
                  <img src="http://localhost/img/1.jpg">
                </a>
          </div>
          <div id="tytul">
            <h1>XDA SDAS DXD AS DASDA SDASDXD ASDAS DX DASDA SDXD ASDA S DXDXDA SDAS D</h1>
          </div>
          <div id="slider">
            <div id="lewo" class="slider-btn">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </div>
            <div id="zdjecia">
              <a class="thumbnail visible-xs">
                  <img src="../img/1.jpg">
                </a>
              <a class="thumbnail">
                <img class="img-responsive" src="../img/2.jpg">
              </a>
              <a class="thumbnail">
                <img class="img-responsive" src="../img/10.jpg">
              </a>
              <a class="thumbnail">
                <img class="img-responsive" src="../img/3.jpg">
              </a>
              <a class="thumbnail">
                <img class="img-responsive" src="../img/2.jpg">
              </a>
              <a class="thumbnail">
                <img class="img-responsive" src="../img/10.jpg">
              </a>
              <a class="thumbnail">
                <img class="img-responsive" src="../img/3.jpg">
              </a>
              <a class="thumbnail">
                <img class="img-responsive" src="../img/2.jpg">
              </a>
              <a class="thumbnail">
                <img class="img-responsive" src="../img/10.jpg">
              </a>
              <a class="thumbnail">
                <img class="img-responsive" src="../img/3.jpg">
              </a>
              <!--TODO: ZROBIĆ POZYCJONOWANIE PRAWEGO BUTTONA W ZALEŻNOŚCI O ILOŚCI ZDJĘĆ-->
            </div>
            <div id="prawo" class="slider-btn">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="jumbotron" id="uzytkownik-info">
        <div class="row">
          <div class="col-sm-3 col-md-2">
            <a class="thumbnail" style="margin-bottom: 0px;">
                <img style="height: 128px; width: 128px;" src="../img/3.jpg">
              </a>
          </div>
          <div class="col-sm-4 col-md-5">
            <h3>Jan Kowalski</h3>
            <p>ADRES I INNE</p>
          </div>
          <div class="col-sm-5">
            <h3>Skontaktuj się</h3>
            <div class="btn-group">
              <a href="#" class="btn btn-info">Wiadomość <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></a>
              <a href="#" class="btn btn-info">Telefon <span class="glyphicon glyphicon-phone" aria-hidden="true"></span></a>
              <div class="btn-group">
                <a href="#" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  Więcej
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">Gadu-Gadu <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span></a></li>
                  <li><a href="#">Poproś o email <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></li>
                  <li><a href="#">Skype <i class="fa fa-skype" aria-hidden="true"></i></a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </div>
            </div>
            <div class="btn-group">
              <a href="#" class="btn btn-danger">Zgłoś naruszenie <span class="fa fa-flag" aria-hidden="true"></span></a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="page-header">
            <h4>
              Opis ogłoszenia
            </h4>
          </div>

        </div>
        <div class="col-sm-4">
          <div class="page-header">
            <h4>
              Informacje
            </h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <div class="panel panel-default">
            <div class="panel-body">
              Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br>              Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br>              Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br>              Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br>              Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br>              Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br>              Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br>              Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br>              Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br>              Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br>              Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br>              Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br>              Opis aukcji<br> Opis aukcji<br> Opis aukcji<br> Opis aukcji<br>
            </div>
          </div>

        </div>
        <div class="col-sm-4">

          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Kategoria</h3>
            </div>
            <div class="panel-body">
              Podkategoria
            </div>
          </div>

          <div class="panel panel-default reklamy">
            <div class="panel-body">
              <img class="responsive-img" src="http://placehold.it/200x250" />
              <img src="http://placehold.it/200x250" />
              <img src="http://placehold.it/200x250" />
              <img src="http://placehold.it/200x250" />
              <img src="http://placehold.it/200x250" />
              <img src="http://placehold.it/200x250" />
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="page-header">
            <h4>
              Podobne ogłoszenia
            </h4>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <a class="thumbnail">
                <img src="http://placehold.it/200x250" />
                <div class="caption">
                  <p>Lorem ipsum...</p>
                </div>
           </a>
        </div>
      </div>

    </div>
    </div>
    <?php require_once(FOOTER); ?>
    <script src="slider.js">
    </script>
    <script src="https://use.fontawesome.com/75c0fa3af9.js"></script>
  </body>

  </html>
