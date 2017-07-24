<?php
  require_once("../config.php");
  require_once(SESJA);
  require_once(BAZA);
  require_once(FPOMOC);
  require("ogloszenieClass.php");
  require(I_UZYTKOWNIK_KAT."uzytkownikClass.php");
  //Sprawdz czy jest parametr id
if (!isset($_GET['id'])) {
    przekieruj(BLAD."?blad=43");
}
$ogloszenie = new Ogloszenie($_GET['id']);
if ($ogloszenie->znajdzOgloszenie()) {
    $ogloszenie->znajdzZdjecia();
} else {
    przekieruj(BLAD."?blad=43");
}
if (isset($_SESSION['idUzytkownika'])) {
    $ogloszenie->sprawdzCzyAdmin($_SESSION['idUzytkownika']);
}
  // TODO: If $_SERVER filename == ogloszenie.php dodaj w navbarze kontrole trybu admina?
$autor = new Uzytkownik($ogloszenie->uzytkownik);
?>

  <!doctype html>
  <html lang="pl">
    <?php require_once(HEAD);
    if ($ogloszenie->saZdjecia) {
        echo "<link rel='stylesheet' href='ogloszenie.css'>
          <style>
            #tlo {
              background-image: url(".IMG_OGLOSZENIA.$ogloszenie->zdjecia[0].");
            }
          </style>";
    } else {
        echo "<link rel='stylesheet' href='ogloszenieBez.css'>";
    }
    ?>

  <body>
    <?php require_once(NAVBAR);?>
    <?php
    if ($ogloszenie->saZdjecia) {
        echo "<div class='jumbotron hidden-xs' id='tlo'>
              </div>
              <div class='container'>
                <div class='row'>
                  <div class='col-sm-12' id='zdjecia-row'>";
                  echo  $ogloszenie->zwrocGlowneZdjecie();
                echo   "<div id='xd'>";
                    echo $ogloszenie->zwrocTytul();
                    echo $ogloszenie->zwrocSlider();
                echo  "</div>
                </div>
              </div>";
    } else {
        echo "<div class='container'>
        <div class='row'>
          <div class='col-sm-12' id='zdjecia-row'>";
            echo $ogloszenie->zwrocTytul();
          echo "</div>
        </div>";
    }
      echo $ogloszenie->zwrocInformacjeUzytkownika($autor, isset($_SESSION['zalogowany']));
    ?>
    <!--TODO: https://stackoverflow.com/questions/30765758/how-to-insert-a-column-between-two-rows-of-another-column-during-responsiveness-->
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
                <?php
                echo $ogloszenie->zwrocTresc();
                ?>
        </div>
        <div class="col-sm-4">

            <?php
            echo $ogloszenie->zwrocInfoOgloszenia();
            ?>
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
