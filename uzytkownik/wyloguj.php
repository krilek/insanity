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
    //FIXME: Wylogowanie kasuje ostatnie, rozwiazanie nie dziala
    $url = $_SESSION['url'];
    $ostatnie = $_SESSION['ostatnieOgloszenia'];
    session_destroy();
    $_SESSION['ostatnieOgloszenia'] = $ostatnie;
    $_SESSION['url'] = $url;
    //FIXME: po wylogowaniu na stronie prywatnej (wiadomosci itp.) przekierowanie musi powrócić do jakiejś innej strony
    if (isset($_SESSION['url'])) {
        przekieruj(ROOT.$_SESSION['url']);
    } else {
        przekieruj(ROOT);
    }
    // $_SESSION['zalogowany'] = false;
    // $_SESSION['login'] = "";
}
