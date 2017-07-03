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
                <!--<div class="btn-group pull-right" role="group" aria-label="...">
                  <a href="" class="btn btn-default">Left</a>
                  <a href="" class="btn btn-default">Middle</a>
                  <a href="" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></a>
                </div>-->
                  <!--TODO: STAŁY HEIGHT? wysokość tekstu 100%? PROBLEM Z WYSOKOŚCIAMI BUTTONÓW-->
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
