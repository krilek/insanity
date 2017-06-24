<?php
require("../config.php");
require_once(BAZA);
require_once(FPOMOC);
session_start();
  if (isset($_POST['login'])&&isset($_POST['haslo'])) {
      $wyn = sprawdzLogin($_POST['login']);
      if (is_string($wyn)) {
          if (zalogujUzytkownika($wyn, $_POST['haslo'])) {
              if (isset($_SESSION['url'])) {
                  przekieruj(ROOT.$_SESSION['url']);
              }
              przekieruj(ROOT);
          } else {
              przekieruj(BLAD."?blad=34");
          }
      } else {
          przekieruj(BLAD."?blad=".$wyn);
      }
  }
function zalogujUzytkownika($login, $haslo)
{
    global $baza;
    if ($wynik = $baza->query("SELECT Hash FROM uzytkownicy JOIN hasla ON hasla.ID = uzytkownicy.ID WHERE Login='$login'")) {
        if ($wynik->num_rows != 1) {
            $wynik->free();
            przekieruj(BLAD."?blad=35");
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
        przekieruj(BLAD."?blad=33");
    }
    return false;
}
function stworzSesje($login)
{
    $_SESSION['zalogowany'] = true;
    $_SESSION['login'] = $login;
    $_SESSION['dataLogowania'] = new DateTime();
    $_SESSION['ostatniaAktywnosc'] = new DateTime();
}
