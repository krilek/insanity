<?php
  include_once("config.php");
  include_once(BAZA);
  include_once(FPOMOC);
  function weryfikujUzytkownika($id, $login, $token)
  {
      global $baza;
      if ($wynik = $baza->query("SELECT ID, Login, TokenHash, Data, Dodano FROM uzytkownicyrejestracja WHERE ID=$id && Login='$login' && TokenHash='$token'")) {
          if ($wynik->num_rows == 1) {
              $wynik = $wynik->fetch_assoc();
              print_r($wynik);
              if ($wynik['Dodano'] == 1) {
                  return 2;
              }
              if (sprDate($wynik['Data'])) {
                  return 1;
              }
          }
          return 0;
      } else {
          return -1;
      }
  }

  function sprDate($data)
  {
      $data = new DateTime($data);
      $dataAktualna = new DateTime();
      $roznica = $data->diff($dataAktualna);
      //Ilosc dni wieksza od 0 oznacza nieważny link aktywacyjny
      if ($roznica->d > 0) {
          return false;
      } else {
          return true;
      }
  }
  function utworzUzytkownika($id, $login, $token)
  {
      global $baza;
    //Dodaj do haseł
    $hasla = "INSERT INTO `hasla` (Hash)
    SELECT  HasloHash
    FROM `uzytkownicyrejestracja` WHERE Login='$login' && ID=$id && TokenHash='$token'";
      if ($baza->query($hasla)) {
          $noweID = $baza->insert_id;
          $emaile = " INSERT INTO `emaile` (ID, Email)
                      SELECT  $noweID, Email
                      FROM `uzytkownicyrejestracja` WHERE Login='$login' && ID=$id &&  TokenHash='$token'";
          if ($baza->query($emaile)) {
              $uzytkownicy = "INSERT INTO `uzytkownicy` (ID, Login, Imie, Nazwisko, Wojewodztwo, Miejscowosc, Plec, Typ)
                              SELECT $noweID, Login, Imie, Nazwisko, Wojewodztwo, Miejscowosc, Plec, Typ
                              FROM `uzytkownicyrejestracja` WHERE Login='$login' && ID=$id &&  TokenHash='$token'";
              if ($baza->query($uzytkownicy)) {
                  //UPDATE statusu aktywacji uzytkownicyrejestracja
                $update = "UPDATE `uzytkownicy` SET Dodano=1 WHERE Login='$login' && ID=$id &&  TokenHash='$token'";
                  if ($baza->query($update)) {
                      echo "UDAŁO SIĘ!";
                  } else {
                      przekieruj("blad.php?blad=30");
                  }
              } else {
                  usunZmiany("emaile");
                  przekieruj("blad.php?blad=29");
              }
          } else {
              usunZmiany("hasla");
              przekieruj("blad.php?blad=28");
          }
      } else {
          przekieruj("blad.php?blad=27");
      }
  }
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
  <div class="container">
    <div class="col-sm-12">
      <?php
      if (isset($_GET['id']) && isset($_GET['login'])&& isset($_GET['token'])) {
          $id = $baza->real_escape_string($_GET["id"]);
          $login = $baza->real_escape_string($_GET["login"]);
          $token = $baza->real_escape_string($_GET["token"]);
          $poprawny = weryfikujUzytkownika($id, $login, $token);
          if ($poprawny == 1) {
              utworzUzytkownika($id, $login, $token);
          } elseif ($poprawny < 0) {
              przekieruj("blad.php?blad=25");
          } elseif ($poprawny == 0) {
              przekieruj("blad.php?blad=26");
          } elseif ($poprawny == 2) {
              przekieruj("blad.php?blad=31");
          }
      } else {
          przekieruj("blad.php?blad=25");
      }
// weryfikujUzytkownika(17, "krilek", "62161512d8b1b5db826778917e974b21");
      ?>
    </div>
  </div>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/rejestracja.js<?php echo '?x='.rand(1, 10);?>"></script>
  <script src="js/navbar.fix.js<?php echo '?x='.rand(1, 10);?>"></script>
</body>

</html>
