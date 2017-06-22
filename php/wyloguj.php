<?php
  session_start();
  include_once("../config.php");
  include_once(FPOMOC);
  wylogujUzytkownika();
  function wylogujUzytkownika(){
    //Zrobić uzywajac splice
    $_SESSION = array();
    // $_SESSION['zalogowany'] = false;
    // $_SESSION['login'] = "";
    przekieruj("http://localhost".$_SESSION['url']);
  }


 ?>
