<?php
  require_once("../config.php");
  require_once(FPOMOC);
  session_start();
  wylogujUzytkownika();
  function wylogujUzytkownika()
  {
      //Zrobić uzywajac splice
    // $_SESSION = array();
    session_destroy();
      if (isset($_SESSION['url'])) {
          przekieruj(ROOT.$_SESSION['url']);
      } else {
          przekieruj(ROOT);
      }
    // $_SESSION['zalogowany'] = false;
    // $_SESSION['login'] = "";
  }
