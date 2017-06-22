<?php
include("../config.php");
include_once(BAZA);
include_once(FPOMOC);
session_start();
print_r($_SESSION);
  if (isset($_POST['login'])&&isset($_POST['haslo'])) {
      $wyn = sprawdzLogin($_POST['login']);
      if (is_string($wyn)) {
          if (zalogujUzytkownika($wyn, $_POST['haslo'])) {
              if (isset($_SESSION['url'])) {
                  przekieruj("http://localhost".$_SESSION['url']);
              } else {
                  przekieruj("http://localhost");
              }
          } else {
              przekieruj("../blad.php?blad=34");
          }
      } else {
          przekieruj("../blad.php?blad=".$wyn);
      }
  }
function zalogujUzytkownika($login, $haslo)
{
    global $baza;
    if ($wynik = $baza->query("SELECT Hash FROM uzytkownicy JOIN hasla ON hasla.ID = uzytkownicy.ID WHERE Login='$login'")) {
        if ($wynik->num_rows != 1) {
            $wynik->free();
            przekieruj("../blad.php?blad=35");
        } else {
            //Zrób coś z wynikiem
          $bazaHash = $wynik->fetch_assoc()['Hash'];
            $wynik->free();
            if (password_verify($haslo, $bazaHash)) {
                stworzSesje($login);
                return true;
            } else {
                return false;
            }
        }
    } else {
        przekieruj("../blad.php?blad=33");
    }
    return false;
}
function stworzSesje($login)
{
  $_SESSION['zalogowany'] = true;
  $_SESSION['login'] = $login;
  $_SESSION['dataLogowania'] = new DateTime();
  $_SESSION['ostatniaAktywnosc'] = new DateTime();
    echo "$login";
}
