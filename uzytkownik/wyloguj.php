<?php
  require_once("../config.php");
  require_once(FPOMOC);
  session_start();
  wylogujUzytkownika();
function wylogujUzytkownika()
{
    //TODO:Zrobić uzywajac splice
    //TODO: ZROBIĆ TO LEPIEJ
    // $_SESSION = array();
    //Zapisz kopie
    $url = $_SESSION['url'];
    $ostatnie = $_SESSION['ostatnieOgloszenia'];
    session_destroy();
    $_SESSION['ostatnieOgloszenia'] = $ostatnie;
    $_SESSION['url'] = $url;
    if (isset($_SESSION['url'])) {
        przekieruj(ROOT.$_SESSION['url']);
    } else {
        przekieruj(ROOT);
    }
    // $_SESSION['zalogowany'] = false;
    // $_SESSION['login'] = "";
}
