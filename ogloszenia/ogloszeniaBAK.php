<?php
  require_once("../config.php");
  require_once(SESJA);
?>

  <!doctype html>
  <html lang="pl">
  <?php require_once(HEAD);?>
  <style>
    .page-header {
      margin-top: 15px;
      margin-bottom: 10px;
    }
  </style>

  <body>
    <?php require_once(NAVBAR);?>
    <div class="container">
      <div class="row hidden-xs">
        <div class="col-sm-8 col-sm-offset-4">
          <div class="page-header">
            <h1>Example Page Header</h1>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="list-group">
            <a href="dodaj_ogloszenie.php" class="list-group-item active">Dodaj ogłoszenie</a>
            <a href="#" class="list-group-item">Aktywne ogłoszenia</a>
            <a href="#" class="list-group-item">Zakończone ogłoszenia</a>
          </div>
        </div>
        <div class="col-sm-8">
          <div class="media">
              <div class="media-left">
                <a href="#">
                  <img class="media-object" src="http://placehold.it/128x128" alt="...">
                </a>
              </div>
              <div class="media-body">
                <h4 class="media-heading">Media heading <span class="label label-info">Info</span></h4>
                <p>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                </p>
                <div class="btn-group pull-right">
                  <a href="#" class="btn btn-default">Left</a>
                  <a href="#" class="btn btn-default">Middle</a>
                  <a href="#" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></a>
                </div>
              </div>
            </div>
          <!-- <div class="list-group">
            <a href="#" class="list-group-item">
                <img class="pull-left img-responsive" src="http://placehold.it/64x64" />
                <h4 class="list-group-item-heading">List group item heading</h4>
            </a>
            <a href="#" class="list-group-item">
              <h4 class="list-group-item-heading">List group item heading</h4>
              <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
            </a>
          </div> -->
        </div>
      </div>
    </div>
    <?php require_once(FOOTER); ?>
  </body>

  </html>
