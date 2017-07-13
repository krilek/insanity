<?php
  require_once("../config.php");
  require_once(WOJEWODZTWA);
  require_once(SESJA);
?>
<!doctype html>

<html lang="pl">

<?php require_once(HEAD); ?>

<body>
  <?php require_once(NAVBAR); ?>
  <?php if (isset($_GET['sukces'])) {
    if ($_GET['sukces'] == 1) {
        echo '
      <div class="jumbotron text-center">
        <h2>Rejestracja przebiegła pomyślnie.</h2>
        <p>Na podany email wysłany został link aktywacyjny.
        Kliknij w niego aby kontynuować.</p>
      </div>
      ';
    }
} else {
    echo '<div class="container">
      <div class="col-sm-4">
        <form class="form-horizontal" method="post" action="'.UZYTKOWNIK_KAT.'rej.php">
              <fieldset>
                <h3><legend>Rejestracja</legend></h3>
                <div class="form-group">
                  <label for="inEmail" class="col-lg-3 control-label">Email</label>
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
                  <span class="col-lg-3"></span>
                  <div class="col-lg-9">
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
                <div class="form-group">
                  <label for="select" class="col-lg-3 control-label">Województwo</label>
                  <div class="col-lg-9">
                    <select class="form-control" name="wojewodztwo" id="select">';

    lista();

    echo '                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="miasto" class="col-lg-3 control-label">Miejscowość</label>
                  <div class="col-lg-9">
                    <input type="text" name="miasto" class="form-control" id="miasto" placeholder="Miejscowość">
                  </div>
                </div>
                <div class="form-group">
                  <input type="hidden" name="tryb" value="rejestracja">
                  <div class="col-lg-9 col-lg-offset-3">
                    <button type="reset" class="btn btn-default">Resetuj</button>
                    <button type="submit" class="btn btn-primary">Wyślij</button>
                  </div>
                </div>
              </fieldset>
              </form>
      </div>
      <div class="col-sm-8">

      </div>
    </div>';
}
  ?>
  <?php
    $rejestracja = true;
    require_once(FOOTER);
   ?>
</body>

</html>
