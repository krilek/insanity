<?php
  include_once("config.php");
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
      <div class="row">
      <?php
          echo '<div class="alert alert-danger">';
          if (isset($_GET['blad'])) {
              switch ($_GET['blad']) {
                case '1':
                  echo "Nie poprawnie wypełniony formularz rejestracyjny.";
                  break;
                case '2':
                  echo "Problem z POST. Skontaktuj się z administratorem.";
                  break;
                case '3':
                  echo "Login zawiera niedozwolone znaki!";
                  break;
                case '4':
                  echo "Login jest za krótki";
                  break;
                case '5':
                  echo "Login jest za długi";
                  break;
                case '6':
                  echo "Hasła się nie zgadzają";
                  break;
                case '7':
                  echo "Hasło za krótkie";
                  break;
                case '8':
                  echo "Hasło za długie";
                  break;
                case '9':
                  echo "Email jest niepoprawny";
                  break;
                case '10':
                  echo "Email jest za krótki";
                  break;
                case '11':
                  echo "Email jest za długi";
                  break;
                case '12':
                  echo "Nazwisko lub imie lub miasto zostały niepoprawnie wypełnione";
                  break;
                case '13':
                  echo "Wprowadzono za długą nazwę miejscowości";
                  break;
                case '14':
                  echo "Wprowadzono za krótką nazwę miejscowości";
                  break;
                case '15':
                  echo "Wprowadzono za krótkie imie";
                  break;
                case '16':
                  echo "Wprowadzono za długie imie";
                  break;
                case '17':
                  echo "Wprowadzono za krótkie nazwisko";
                  break;
                case '18':
                  echo "Wprowadzono za długie nazwisko";
                  break;
                case '20':
                  echo "Błąd z serwerem KOD 20. Skontakutj się z administratorem ";
                  break;
                case '19':
                  echo "Ten login jest już w użyciu";
                  break;
                case '21':
                  echo "Ten email jest już w użyciu lub jest niepoprawny";
                  break;
                case '22':
                  echo "Ten login i email są już w użyciu lub są błędne";
                  break;
                case '23':
                  echo "Błąd przy rejestracji. Kod błędu 23";
                  break;
                case '24':
                  echo "Użytkownik o takim adresie email został już zarejestrowany i prawdopodobnie nie potwierdzony.";
                  break;
                case '25':
                  echo "Niepoprawny link weryfikacyjny";
                  break;
                case '26':
                  echo "Ten link aktywacyjny wygasł";
                  break;
                case '27':
                  echo "Błąd przy potwierdzaniu adresu email, KOD BŁĘDU 27";
                  break;
                case '28':
                  echo "Błąd przy potwierdzaniu adresu email, KOD BŁĘDU 28";
                  break;
                case '29':
                  echo "Błąd przy potwierdzaniu adresu email, KOD BŁĘDU 29";
                  break;
                case '30':
                  echo "Błąd przy potwierdzaniu adresu email, KOD BŁĘDU 30";
                  break;
                case '31':
                  echo "Użytkownik o danym adresie email został już potwierdzony";
                  break;

                default:
                  echo "Nieznany kod błędu.";
            }
          } else {
              echo "Nie sprecyzowano kodu błędu.";
          }
          echo '</div>';
      ?>
    </div>
    </div>
  </div>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/navbar.fix.js"></script>
</body>

</html>
