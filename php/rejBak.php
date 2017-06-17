<?php
  require_once("../config.php");
  require_once(BAZA);
  if (isset($_POST['tryb'])) {
      $tryb = $_POST['tryb'];
      if ($tryb == 'info') {
          if ($_POST['tryb2'] == "login") {
              $login = $baza->real_escape_string($_POST['wartosc']);
              $zapytanie = sprintf("SELECT Login FROM uzytkownicy WHERE Login = '%s'", $login);
        // echo $zapytanie;
        // print_r($baza);
        $wynik = $baza->query($zapytanie);
        // print_r($wynik);
        if ($wynik) {
            if ($wynik->num_rows == 0) {
                echo '<div class="alert alert-success"  data-dismiss="alert">
              <button type="button" class="close" data-dissmiss="alert">×</button>
              Ten login jest dostępny
            </div>';
            } else {
                echo '<div class="alert alert-danger">
              Ten login jest już w użyciu
            </div>';
            }
        } else {
            echo "Problem z zapytaniem. Skontaktuj się z administratorem err: #REJ1";
        }
          } elseif ($_POST['tryb2'] == "email") {
              $email = $baza->real_escape_string($_POST['wartosc']);
              $zapytanie = sprintf("SELECT Email FROM emaile WHERE Email='%s'", $email);
              $wynik = $baza->query($zapytanie);
              if ($wynik) {
                  if ($wynik->num_rows == 0) {
                      echo '<div class="alert alert-success"  data-dismiss="alert">
              <button type="button" class="close" data-dissmiss="alert">×</button>
              Ten email jest dostępny
            </div>';
                  } else {
                      echo '<div class="alert alert-danger">
              Ten email jest już w użyciu
            </div>';
                  }
              } else {
                  echo "Problem z zapytaniem. Skontaktuj się z administratorem err: #REJ2";
              }
          }
      } elseif ($tryb == 'rejestracja') {
          if (filter_has_var(INPUT_POST, 'email')&& !empty($_POST['email']) &&
              filter_has_var(INPUT_POST, 'login') && !empty($_POST['login'])&&
              filter_has_var(INPUT_POST, 'haslo')&& !empty($_POST['haslo'])&&
              filter_has_var(INPUT_POST, 'haslo2')&& !empty($_POST['haslo2'])&&
              filter_has_var(INPUT_POST, 'imie')&& !empty($_POST['imie'])&&
              filter_has_var(INPUT_POST, 'nazwisko')&& !empty($_POST['nazwisko'])&&
              filter_has_var(INPUT_POST, 'plec')&&
              filter_has_var(INPUT_POST, 'miasto')&& !empty($_POST['miasto'])&&
              filter_has_var(INPUT_POST, 'wojewodztwo')) {
              $imie = "";
              $nazwisko = "";
              $plec = "";
              $miasto = "";
              $email = "";
              $login = "";
              $haslo = "";
              $haslo2 = "";
              // print_r($_POST);
              if (preg_match('[\W]', $_POST['login'])) {
                  echo "Login zawiera niedozwolone znaki!";
              } else {
                  $login = $_POST['login'];
                  if (strlen($login) < 5) {
                      echo "Login jest za krótki";
                  } elseif (strlen($login) > 25) {
                      echo "Login jest za długi";
                  } else {
                      $haslo = $_POST['haslo'];
                      $haslo2 = $_POST['haslo2'];
                      if ($haslo != $haslo2) {
                          echo "Hasła się nie zgadzają";
                      } else {
                          if (strlen($haslo) < 6) {
                              echo "Hasło jest za krótkie";
                          } else {
                              $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                              if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                  echo "Nie poprawny email";
                              } elseif (strlen($email)>256) {
                                  echo "Wprowadzono za długi email";
                              } else {
                                  $miasto = filter_input(INPUT_POST, 'miasto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                  if (strlen($miasto) > 100) {
                                      echo "Wprowadzono za długą nazwę miejscowości";
                                  } elseif (strlen($miasto) < 3) {
                                      echo "Wprowadzono za krótką nazwę miejscowości";
                                  } else {
                                      $imie = filter_input(INPUT_POST, 'imie', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                      $nazwisko = filter_input(INPUT_POST, 'nazwisko', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                                      if (strlen($imie) < 2) {
                                          echo "Wprowadzono za krótkie imie";
                                      } elseif (strlen($imie) > 50) {
                                          echo "Wprowadzono za długie imie";
                                      } else {
                                          if (strlen($nazwisko) < 2) {
                                              echo "Wprowadzono za krótkie nazwisko";
                                          } elseif (strlen($nazwisko) > 50) {
                                              echo "Wprowadzono za długie nazwisko";
                                          } else {
                                              //FUNKCJA!
                                              $plec = $baza->real_escape_string($_POST['plec']);
                                              $woj = $baza->real_escape_string($_POST['wojewodztwo']);
                                              dodajUzytkownika($login, $haslo, $email, $imie, $nazwisko, $plec, $miasto, $woj);
                                          }
                                      }
                                  }
                              }
                          }
                      }
                  }
              }
              // echo $email." ".$miasto." ".$login." ".$haslo." ".$haslo2."<br>";
          } else {
              echo "Nie poprawnie wypełniony formularz";
          }
      }
  }

function czyIstnieje($login, $email)
{
}

function dodajUzytkownika($login, $haslo, $email, $imie, $nazwisko, $plec, $miasto, $woj)
{
    // echo "Login: ".$login." Hasło: ".$haslo." Email: ".$email." Imie: ".$imie;
    // echo " Nazwisko: ".$nazwisko." Plec: ".$plec." Miasto: ".$miasto." Województwo: ".$woj;
    //
    global $baza;
    //Przygotowanie hasha
    $passHash = password_hash($haslo, PASSWORD_BCRYPT);
    $tokenHash = md5(rand(0, 10000));
    //Dodanie hasha do tabeli hash
    $id;
    $dodajDoBazy = "INSERT INTO uzytkownicyrejestracja () VALUES";
    // if ($baza->query("INSERT INTO hasla (Hash) VALUES ('$hash')")) {
    //     $id = $baza->insert_id;
    //     if ($baza->query("INSERT INTO emaile (ID, Email) VALUES ('$id', '$email')")) {
    //         $dodaj = $baza->stmt_init();
    //         if ($dodaj->prepare("INSERT INTO uzytkownicy (ID, Login, Imie, Nazwisko, Wojewodztwo, Miejscowosc, Plec) VALUES (? , ?, ?, ?, ?, ?, ?)")) {
    //             if ($dodaj->bind_param("isssiss", $id, $login, $imie, $nazwisko, $woj, $miasto, $plec)) {
    //                 if ($dodaj->execute()) {
    //                     echo "Dodano użytkownika";
    //                 } else {
    //                     echo "Błąd z bazą NUMER 14. Skontakutj się z administratorem ";
    //                     echo $dodaj->error;
    //                     // cofnijZmiany($id, true);
    //                 }
    //             } else {
    //                 echo "Błąd z bazą NUMER 13. Skontakutj się z administratorem ";
    //                 echo $dodaj->error;
    //                 // cofnijZmiany($id, true);
    //             }
    //         } else {
    //             echo "Błąd z bazą NUMER 12. Skontakutj się z administratorem ";
    //             echo $dodaj->error;
    //             // cofnijZmiany($id, true);
    //         }
    //     } else {
    //         echo "Błąd z bazą NUMER 11. Skontakutj się z administratorem ";
    //         echo $dodaj->error;
    //         // cofnijZmiany($id);
    //     }
    // } else {
    //     echo "Błąd z bazą NUMER 10. Skontakutj się z administratorem ";
    //     echo $dodaj->error;
    // }
}
//
// function cofnijZmiany($id, $dwaWpisy = false)
// {
//     global $baza;
//     if ($id > 0) {
//         $qHaslo = "DELETE FROM hasla WHERE ID=".$id;
//         $qHasloAlter = "ALTER TABLE hasla auto_increment = ".($id-1);
//         $qEmail = "DELETE FROM emaile WHERE ID=".$id;
//         $qEmailAlter = "ALTER TABLE emaile auto_increment = ".($id-1);
//     }
//     if ($baza->query($qHaslo)) {
//         echo "Usunięto zbędne hasło";
//     } else {
//         echo "Błąd z bazą NUMER 14. Skontakutj się z administratorem ".$baza->error;
//     }
//     if ($dwaWpisy) {
//         if ($baza->query($qEmail)) {
//             echo "Usunięto zbędny email";
//         } else {
//             echo "Błąd z bazą NUMER 15. Skontakutj się z administratorem ".$baza->error;
//         }
//     }
// }
