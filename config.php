<?php
      //GLOBLNE
      mb_language("uni");
      define('T_PREFIX', "Tytuł strony");
      define('MAX_ZDJEC', 6);
      define('MAX_OSTATNICH_OGLOSZEN', 6);
      //PRZEKIERUJ
if ($_SERVER['SERVER_NAME'] == "lajtowetesty.cba.pl") {
    define('ROOT', "http://lajtowetesty.cba.pl/");
} else {
    define('ROOT', "http://".$_SERVER['SERVER_NAME']."/");
}
      define('BAZOWY_KAT', ROOT."bazowe/");
      define('UZYTKOWNIK_KAT', ROOT."uzytkownik/");
      define('OGLOSZENIA_KAT', ROOT."ogloszenia/");
      define('CSS_KAT', ROOT."css/");
      define('JS_KAT', ROOT."js/");
      define('IMG_KAT', ROOT."img/");
        define('IMG_OGLOSZENIA', IMG_KAT."ogloszenia/");
        define('IMG_UZYTKOWNICY', IMG_KAT."uzytkownicy/");
      define('WIADOMOSCI_KAT', ROOT."wiadomosci/");

      define('BLAD', BAZOWY_KAT."blad.php");




      //DOŁĄCZENIE
      define('SERVER_ROOT', dirname(__FILE__).'/');
      define('I_BAZOWY_KAT', SERVER_ROOT."bazowe/");
      define('I_UZYTKOWNIK_KAT', SERVER_ROOT."uzytkownik/");
      define('I_OGLOSZENIA_KAT', SERVER_ROOT."ogloszenia/");
      define('I_CSS_KAT', SERVER_ROOT."css/");
      define('I_JS_KAT', SERVER_ROOT."js/");
      define('I_IMG_KAT', SERVER_ROOT."img/");
        define('I_IMG_OGLOSZENIA', I_IMG_KAT."ogloszenia/");
        define('I_IMG_UZYTKOWNICY', I_IMG_KAT."uzytkownicy/");
      define('I_WIADOMOSCI_KAT', SERVER_ROOT."wiadomosci/");

      define('FOOTER', I_BAZOWY_KAT."html_foot.php");
      define('NAVBAR', I_BAZOWY_KAT."html_navbar.php");
      define('HEAD', I_BAZOWY_KAT."html_head.php");
      define('SESJA', I_BAZOWY_KAT."sesja.php");

      define('MIEJSCOWOSC', I_BAZOWY_KAT.'miejscowosc.php');
      define('BAZA', I_BAZOWY_KAT.'baza.php');
      define('FPOMOC', I_BAZOWY_KAT.'funkcjePomoc.php');

require_once(I_BAZOWY_KAT."db_settings.php");
