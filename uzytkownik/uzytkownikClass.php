<?php
class Uzytkownik
{
    public $id;
    public $login;
    public $imie;
    public $nazwisko;
    public $wojewodztwo;
    public $miejscowosc;
    public $plec;
    public $avatar;
    function __construct($id)
    {
        global $baza;
        $uzytkownikQuery =
          "SELECT `uzytkownicy`.`ID`, `uzytkownicy`.`Login`,
		              `uzytkownicy`.`Imie`,`uzytkownicy`.`Nazwisko`,
                  `wojewodztwa`.`Nazwa` as Wojewodztwo, `uzytkownicy`.`Miejscowosc`,
                  `uzytkownicy`.`Plec`
              FROM uzytkownicy 
              JOIN wojewodztwa ON `wojewodztwa`.`ID` = `uzytkownicy`.`Wojewodztwo`
           WHERE `uzytkownicy`.`ID`=$id";
        $wynik = $baza->query($uzytkownikQuery);
        $wynik = $wynik->fetch_assoc();
        $this->id = $id;
        $this->login = $wynik['Login'];
        $this->imie = $wynik['Imie'];
        $this->nazwisko = $wynik['Nazwisko'];
        $this->wojewodztwo = $wynik['Wojewodztwo'];
        $this->miejscowosc = $wynik['Miejscowosc'];
        $this->plec = $wynik['Plec'];
        $this->avatar = null;
    }
}
