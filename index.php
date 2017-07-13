<?php
  require_once("config.php");
  require_once(SESJA);
?>

  <!doctype html>

  <html lang="pl">
  <?php require_once(HEAD);?>
  <style>
    .thumbnail {
      display: inline-block;
    }
  </style>

  <body>
    <?php require_once(NAVBAR);?>

    <div class="container">
      <div class="row">
        <div class="col-sm-3">
          <h3>Wybierz województwo</h3>
          <?php require(WOJEWODZTWA);
        nawigacja();
        ?>
          <!-- <ul class="nav nav-pills nav-stacked">
          <li><a href="#">Profile</a></li>

          <li class="active"><a href="#">Home</a></li>
          <!-- <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              Dropdown <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </li>
        </ul>-->
        </div>
        <div class="col-sm-9">
          <div class="row">
            <!--//FIXME: Musisz generować całe kolumny i np lg-2, md-3, sm-4 itd. To może nie zadziałać-->
            <div class="col-sm-12">
              <h2>Najnowsze</h2>
              <a class="thumbnail">
                <img src="http://placehold.it/192x192" />
                <div class="caption">
                  <p>Lorem ipsum...</p>
                </div>
              </a>
              <a class="thumbnail">
                <img src="http://placehold.it/192x192" />
                <div class="caption">
                  <p>Lorem ipsum...</p>
                </div>
              </a>
              <a class="thumbnail">
                <img src="http://placehold.it/192x192" />
                <div class="caption">
                  <p>Lorem ipsum...</p>
                </div>
              </a>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <h2>Najpopularniejsze</h2>
              <div class="col-xs-6 col-sm-4 col-md-3">
                <a class="thumbnail">
                <img src="http://placehold.it/192x192" />
                <div class="caption">
                  <p>Lorem ipsum...</p>
                </div>
              </a>

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <h2>W twoim regionie</h2>
              <div class="col-xs-6 col-sm-4 col-md-3">
                <a class="thumbnail">
                <img src="http://placehold.it/192x192" />
                <div class="caption">
                  <p>Lorem ipsum...</p>
                </div>
              </a>
              </div>

            </div>
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-sm-12">
          <h2>Ostatnio przeglądane</h2>
          <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
            <a class="thumbnail">
            <img src="http://placehold.it/192x192" />
            <div class="caption">
              <p>Lorem ipsum...</p>
            </div>
          </a>
          </div>

        </div>
      </div>

    </div>
    <?php require_once(FOOTER); ?>
  </body>

  </html>