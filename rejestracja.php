<?php
  include_once("config.php");
  require_once(WOJEWODZTWA);
?>
<!doctype html>

<html lang="pl">

<head>
  <meta charset="utf-8">

  <title>R</title>
  <meta name="description" content="ROPIS">
  <meta name="author" content="krilek">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.fix.css?x="<?php echo rand(1, 10); ?>>

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <a class="navbar-brand" href="index.php">Brand</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
          <li><a href="#">Link</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li class="divider"></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-left">
          <li><a href="#">Link</a></li>
        </ul>
        <form class="navbar-form navbar-right" role="logowanie">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Login">
            <input type="text" class="form-control" placeholder="Hasło">
          </div>
          <button type="submit" class="btn btn-default">Zaloguj</button>
          <a class="btn btn-default" href="rejestracja.php">Rejestracja</a>
        </form>
      </div>
    </div>
  </nav>
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
        <form class="form-horizontal" method="post" action="/php/rej.php">
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

  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/rejestracja.js<?php echo '?x='.rand(1, 10);?>"></script>
  <script src="js/navbar.fix.js"></script>
</body>

</html>
