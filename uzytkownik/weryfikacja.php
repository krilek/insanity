<?php
  require_once("../config.php");
  require_once(BAZA);
  require_once(FPOMOC);
function weryfikujUzytkownika($id, $login, $token)
{
    global $baza;
    if ($wynik = $baza->query("SELECT ID, Login, TokenHash, Data, Dodano FROM uzytkownicyrejestracja WHERE ID=$id && Login='$login' && TokenHash='$token'")) {
        if ($wynik->num_rows == 1) {
            $wynik = $wynik->fetch_assoc();
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
    $emaile = " INSERT INTO `emaile` (Email)
      SELECT Email
      FROM `uzytkownicyrejestracja` WHERE Login='$login' && ID=$id &&  TokenHash='$token'";
    //Dodaj do emaili
    if ($baza->query($emaile)) {
        //Uzyj ostatniego auto_increment
        $noweID = $baza->insert_id;
        $hasla = "INSERT INTO `hasla` (ID, Hash)
          SELECT  $noweID, HasloHash
          FROM `uzytkownicyrejestracja` WHERE Login='$login' && ID=$id && TokenHash='$token'";
        //Dodaj do haseł
        if ($baza->query($hasla)) {
            $uzytkownicy = "INSERT INTO `uzytkownicy` (ID, Login, Imie, Nazwisko, Miejscowosc, Plec, Typ)
                              SELECT $noweID, Login, Imie, Nazwisko, Miejscowosc, Plec, Typ
                              FROM `uzytkownicyrejestracja` WHERE Login='$login' && ID=$id &&  TokenHash='$token'";
            if ($baza->query($uzytkownicy)) {
                //UPDATE statusu aktywacji uzytkownicyrejestracja
                $update = "UPDATE `uzytkownicyrejestracja` SET Dodano=1 WHERE Login='$login' && ID=$id &&  TokenHash='$token'";
                if ($baza->query($update)) {
                    dodano();
                } else {
                    przekieruj(BLAD."?blad=30");
                }
            } else {
                usunZmiany("hasla");
                przekieruj(BLAD."?blad=29");
            }
        } else {
            usunZmiany("emaile");
            przekieruj(BLAD."?blad=28");
        }
    } else {
        przekieruj(BLAD."?blad=27");
    }
}
function dodano()
{
    echo "<h2>Adres email został potwierdzony.</h2>";
    echo "<p>Możesz już się zalogować</p>";
}
?>
<!doctype html>

<html lang="pl">

<?php require_once(HEAD); ?>

<body>
    <?php require_once(NAVBAR); ?>
  <div class="jumbotron text-center">
        <?php
        if (isset($_GET['id']) && isset($_GET['login'])&& isset($_GET['token'])) {
            $id = $baza->real_escape_string($_GET["id"]);
            $login = $baza->real_escape_string($_GET["login"]);
            $token = $baza->real_escape_string($_GET["token"]);
            $poprawny = weryfikujUzytkownika($id, $login, $token);
            if ($poprawny == 1) {
                utworzUzytkownika($id, $login, $token);
            } elseif ($poprawny < 0) {
                przekieruj(BLAD."?blad=25");
            } elseif ($poprawny == 0) {
                przekieruj(BLAD."?blad=26");
            } elseif ($poprawny == 2) {
                przekieruj(BLAD."?blad=31");
            }
        } else {
            przekieruj(BLAD."?blad=25");
        }
        ?>
  </div>
    <?php  require_once(FOOTER) ?>

</body>

</html>
