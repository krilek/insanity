<?php
  require_once("../config.php");
  require_once(BAZA);
  require_once(FPOMOC);
  if (isset($_POST['tryb'])) {
      $tryb = $_POST['tryb'];
      if ($tryb == 'info') {
          //AJAX
          switch (czyIstnieje($_POST['login'], $_POST['email'])) {
            case 0:
              echo '<div class="alert alert-success"  data-dismiss="alert">
                   <button type="button" class="close" data-dissmiss="alert">×</button>
                   Ten email i login jest dostępny.
                 </div>';
              break;
            case 1:
              echo '<div class="alert alert-danger">
                      Ten login jest już w użyciu
                    </div>';
              break;
            case 2:
              echo '<div class="alert alert-danger">
                      Ten email jest już w użyciu lub jest niepoprawny
                    </div>';
              break;
            case 3:
              echo '<div class="alert alert-danger">
                      Ten login i email są już w użyciu lub są błędne
                    </div>';
              break;
            default:
              echo '<div class="alert alert-danger">
                      Błąd z serwerem KOD 19. Skontakutj się z administratorem ";
                    </div>';
              break;
        }
      } elseif ($tryb == 'rejestracja') {
          if (filter_has_var(INPUT_POST, 'email')&& !empty($_POST['email']) &&
              filter_has_var(INPUT_POST, 'login') && !empty($_POST['login'])&&
              filter_has_var(INPUT_POST, 'haslo')&& !empty($_POST['haslo'])&&
              filter_has_var(INPUT_POST, 'haslo2')&& !empty($_POST['haslo2'])&&
              filter_has_var(INPUT_POST, 'imie')&& !empty($_POST['imie'])&&
              filter_has_var(INPUT_POST, 'nazwisko')&& !empty($_POST['nazwisko'])&&
              filter_has_var(INPUT_POST, 'plec')&& !empty($_POST['plec'])&&
              filter_has_var(INPUT_POST, 'wojewodztwo')&& !empty($_POST['wojewodztwo'])&&
              filter_has_var(INPUT_POST, 'miasto')&& !empty($_POST['miasto'])) {
              $czysteRasowoDane = sprawdzDane();
              if (is_array($czysteRasowoDane)) {
                  print_r($czysteRasowoDane);
                  dUzytkTymczas($czysteRasowoDane);
              } else {
                  przekieruj("../blad.php?blad=".$czysteRasowoDane);
              }
          } else {
              przekieruj("../blad.php?blad=1");
          }
      }
  } else {
      przekieruj("../blad.php?blad=2");
  }

function czyIstnieje($login, $email)
{
    $zwroc = 0;
    global $baza;
    $login = $baza->real_escape_string($login);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ($wynik = $baza->query("SELECT Login FROM uzytkownicy WHERE Login='$login'")) {
        if ($wynik->num_rows > 0) {
            $zwroc++;
        }
    } else {
        return -1;
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($wynik = $baza->query("SELECT Email FROM emaile WHERE Email='$email'")) {
            if ($wynik->num_rows > 0) {
                $zwroc+=2;
            }
        } else {
            return -1;
        }
    } else {
        $zwroc+=2;
    }
    return $zwroc;
}

function czyIstniejeTymczasowy($email)
{
    global $baza;
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if ($wynik = $baza->query("SELECT Email FROM uzytkownicyrejestracja WHERE Email='$email'")) {
            if ($wynik->num_rows > 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return -1;
        }
    } else {
        return -1;
    }
}

function sprawdzDane()
{
    global $baza;
    $zwroc = array('email' => '', 'login' => '', 'haslo' => '',
                    'imie' => '','nazwisko'=>'','plec' => '',
                    'wojewodztwo' =>'','miasto'=>'');
    //DUPLIKAT W UŻYTKOWNIKACH TYMCZASOWYCH
    $duplikat = czyIstniejeTymczasowy($_POST['email']);
    if ($duplikat < 0) {
        return 20;
    } elseif ($duplikat == 1) {
        return 24;
    }
    //DUPLIKAT W UZYTKOWNIKACH
    $duplikat = czyIstnieje($_POST['login'], $_POST['email']);
    if ($duplikat < 0) {
        return 20;
    } elseif ($duplikat == 1) {
        return 19;
    } elseif ($duplikat == 2) {
        return 21;
    } elseif ($duplikat == 3) {
        return 22;
    }
    //LOGIN
    if (preg_match('[\W]', $_POST['login'])) {
        return 3;
    } elseif (strlen($_POST['login']) < 5) {
        return 4;
    } elseif (strlen($_POST['login']) > 25) {
        return 5;
    } else {
        $zwroc['login'] = $_POST['login'];
    }
    //HASLO
    if ($_POST['haslo'] != $_POST['haslo2']) {
        return 6;
    } elseif (strlen($_POST['haslo']) < 5) {
        return 7;
    } elseif (strlen($_POST['haslo']) > 50) {
        return 8;
    } else {
        $zwroc['haslo'] = $_POST['haslo'];
    }
    //EMAIL
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (!$email || $email == null) {
        return 9;
    } else {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email || $email == null) {
            return 9;
        } elseif (strlen($email) < 5) {
            return 10;
        } elseif (strlen($email) > 250) {
            return 11;
        } else {
            $zwroc['email'] = $email;
        }
    }
    //IMIE, NAZWISKO, MIASTO
    $miasto = filter_input(INPUT_POST, 'miasto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $imie = filter_input(INPUT_POST, 'imie', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nazwisko = filter_input(INPUT_POST, 'nazwisko', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$miasto || $miasto == null || !$imie || $imie == null || !$nazwisko || $nazwisko == null) {
        return 12;
    } else {
        if (strlen($miasto) > 100) {
            return 13;
        } elseif (strlen($miasto) < 3) {
            return 14;
        } else {
            $zwroc['miasto'] = $miasto;
        }

        if (strlen($imie) < 2) {
            return 15;
        } elseif (strlen($imie) > 50) {
            return 16;
        } else {
            $zwroc['imie'] = $imie;
        }

        if (strlen($nazwisko) < 2) {
            return 17;
        } elseif (strlen($nazwisko) > 50) {
            return 18;
        } else {
            $zwroc['nazwisko'] = $nazwisko;
        }
    }
    //PLEC, WOJEWODZTWO
    $zwroc['plec'] = $baza->real_escape_string($_POST['plec']);
    $zwroc['wojewodztwo'] = $baza->real_escape_string($_POST['wojewodztwo']);

    return $zwroc;
}






// function dodajUzytkownika($login, $haslo, $email, $imie, $nazwisko, $plec, $miasto, $woj)
function dUzytkTymczas($uzytkTab)
{

    // echo "Login: ".$login." Hasło: ".$haslo." Email: ".$email." Imie: ".$imie;
    // echo " Nazwisko: ".$nazwisko." Plec: ".$plec." Miasto: ".$miasto." Województwo: ".$woj;
    //
    global $baza;
    //Przygotowanie hasha
    $hasloHash = password_hash($uzytkTab['haslo'], PASSWORD_BCRYPT);
    $tokenHash = md5(rand(0, 10000));
    $dodajDoBazy = "INSERT INTO uzytkownicyrejestracja
    (Login, Email, HasloHash, TokenHash, Imie, Nazwisko, Wojewodztwo, Miejscowosc, Plec, Typ, Data) VALUES ";
    $dodajDoBazy .= "( '".$uzytkTab['login'];
    $dodajDoBazy .= "' ,'".$uzytkTab['email'];
    $dodajDoBazy .= "' ,'".$hasloHash;
    $dodajDoBazy .= "' ,'".$tokenHash;
    $dodajDoBazy .= "' ,'".$uzytkTab['imie'];
    $dodajDoBazy .= "' ,'".$uzytkTab['nazwisko'];
    $dodajDoBazy .= "' ,".$uzytkTab['wojewodztwo'];
    $dodajDoBazy .= " ,'".$uzytkTab['miasto'];
    $dodajDoBazy .= "' ,'".$uzytkTab['plec'];
    $dodajDoBazy .= "' , 1";
    $dodajDoBazy .= " ,"."FROM_UNIXTIME(".time()."));";
    echo "$dodajDoBazy";
    if ($baza->query($dodajDoBazy)) {
        $id = $baza->insert_id;
        rejestracjaEmail($uzytkTab['email'], $uzytkTab['imie'], $id, $uzytkTab['login'], $tokenHash);
    } else {
        // echo "blad";
      //   echo $baza->error;
        przekieruj("../blad.php?blad=23");
    }
    // if ($baza->query("INSERT INTO hasla (Hash) VALUES ('$hash')")) {
    //     $id = $baza->insert_id;
    //     if ($baza->query("INSERT INTO emaile (ID, Email) VALUES ('$id', '$email')")) {
    //         $dodaj = $baza->stmt_init();
    //         if ($dodaj->prepare("INSERT INTO uzytkownicy (ID, Login, Imie, Nazwisko, Wojewodztwo, Miejscowosc, Plec) VALUES (? , ?, ?, ?, ?, ?, ?)")) {
    //             if ($dodaj->bind_param("isssiss", $id, $login, $imie, $nazwisko, $woj, $miasto, $plec)) {
    //                 if ($dodaj->execute()) {
    //                     echo "Dodano użytkownika";
    //                 } else {
    //                     echo "Błąd z bazą KOD 14. Skontakutj się z administratorem ";
    //                     echo $dodaj->error;
    //                     // cofnijZmiany($id, true);
    //                 }
    //             } else {
    //                 echo "Błąd z bazą KOD 13. Skontakutj się z administratorem ";
    //                 echo $dodaj->error;
    //                 // cofnijZmiany($id, true);
    //             }
    //         } else {
    //             echo "Błąd z bazą KOD 12. Skontakutj się z administratorem ";
    //             echo $dodaj->error;
    //             // cofnijZmiany($id, true);
    //         }
    //     } else {
    //         echo "Błąd z bazą KOD 11. Skontakutj się z administratorem ";
    //         echo $dodaj->error;
    //         // cofnijZmiany($id);
    //     }
    // } else {
    //     echo "Błąd z bazą KOD 10. Skontakutj się z administratorem ";
    //     echo $dodaj->error;
    // }
}
function rejestracjaEmail($email, $imie, $id, $login, $token)
{
    $wiadomosc = <<<WIAD
    Witaj $imie!
    W serwisie ____ zarejestrowano użytkownika o loginie $login.\r\n
    Aby potwierdzić rejestrację kliknij link poniżej\r\n
    http://localhost/weryfikacja.php?id=$id&login=$login&token=$token
    Jeśli to nie ty, zignoruj tę wiadomość.
WIAD;
    echo $wiadomosc;
    wyslijMail($email, $wiadomosc, "Rejestracja w serwisie ____");
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
//         echo "Błąd z bazą KOD 14. Skontakutj się z administratorem ".$baza->error;
//     }
//     if ($dwaWpisy) {
//         if ($baza->query($qEmail)) {
//             echo "Usunięto zbędny email";
//         } else {
//             echo "Błąd z bazą KOD 15. Skontakutj się z administratorem ".$baza->error;
//         }
//     }
// }
