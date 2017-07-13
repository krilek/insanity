<?php
require_once("../config.php");
?>
<!doctype html>

<html lang="pl">

<?php require_once(HEAD); ?>

<body>
    <?php require_once(NAVBAR); ?>
  <div class="jumbotron text-center">
        <?php
          echo '<div class="alert alert-danger">
          <h3><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ';
        if (isset($_GET['blad'])) {
            switch ($_GET['blad']) {
                case '1':
                    echo "Niepoprawnie wypełniony formularz rejestracyjny.";
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
                    echo "Podane hasła nie są takie same";
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
                    echo "Nazwisko, imie lub miasto zostały niepoprawnie wypełnione";
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
                    echo "Błąd z serwerem KOD 20. Skontaktuj się z administratorem ";
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
                    echo "Użytkownik o takim adresie email został już zarejestrowany.";
                    break;
                case '25':
                    echo "Niepoprawny link weryfikacyjny";
                    break;
                case '26':
                    echo "Ten link aktywacyjny wygasł";
                    break;
                case '27':
                    echo "Nie wiem jak to zrobiłaś/zrobiłeś ale ten email jest już w bazie, KOD BŁĘDU 27";
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
                case '33':
                    echo "Błąd logowania, problem z bazą danych. Skontaktuj się z administratorem";
                    break;
                case '34':
                    echo "Błąd logowania, spróbuj ponownie";
                    break;
                case '35':
                    echo "Błąd logowania, podane dane do logowania są niepoprawne";
                    break;
                case '36':
                    echo "Błąd związany z wybraną kategorią";
                    break;
                case '37':
                    echo "Niepoprawny format ceny";
                    break;
                case '38':
                    echo "Błąd związany z wybranym typem ogłoszenia";
                    break;
                case '39':
                    echo "Podany tytuł jest niepoprawnej długości. Minimalna długość 5 znaków, maksymalna 50";
                    break;
                case '40':
                    echo "W wybranym typie oferty należy podać cenę";
                    break;
                case '41':
                    echo "Podczas dodawania zdjęć wystąpiły błędy. Upewnij się że rozmiar zdjęć jest mniejszy niż 500KB";
                    break;
                case '42':
                    echo "Niepoprawnie wypełniony formularz dodawania ogłoszenia";
                    break;
                case '32':
                    echo "Problem z zapytaniem do bazy danych. Skontaktuj się z administratorem";
                    break;
                case '100':
                    echo "Błąd połączenia z bazą danych. Strona jest aktualnie w konserwacji.";
                    break;
                case '101':
                    echo "Musisz być zalogowany.";
                    break;
                default:
                    echo "Nieznany kod błędu.";
            }
        } else {
            echo "Nie sprecyzowano kodu błędu.";
        }
          echo '</h3>
          </div>';
        ?>
  </div>
    <?php require_once(FOOTER); ?>
</body>

</html>
