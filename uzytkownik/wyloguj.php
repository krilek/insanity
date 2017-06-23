<?php
  session_start();
  require_once("../config.php");
  require_once(FPOMOC);
  wylogujUzytkownika();
  function wylogujUzytkownika()
  {
      //Zrobić uzywajac splice
    // $_SESSION = array();
      session_destroy();
    // $_SESSION['zalogowany'] = false;
    // $_SESSION['login'] = "";
    przekieruj("http://localhost".$_SESSION['url']);
  }
