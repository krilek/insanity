<?php
class Uzytkownik
{
    public $id;
    public $login;
    public $imie;
    public $nazwisko;
    public $miejscowosc;
    public $wojewodztwo;
    public $powiat;
    public $plec;
    public $avatar;
    function __construct($id)
    {
        global $baza;
        $uzytkownikQuery =
          "SELECT `uzytkownicy`.`ID`, `uzytkownicy`.`Login`,
		              `uzytkownicy`.`Imie`,`uzytkownicy`.`Nazwisko`,
                  `uzytkownicy`.`Miejscowosc`, `uzytkownicy`.`Plec`,
                  `miejscowosc`.`Nazwa` AS Miejscowosc, `wojewodztwo`.`Nazwa` AS Wojewodztwo,
                  `powiat`.`Nazwa` AS Powiat
              FROM uzytkownicy 
              JOIN miejscowosc ON miejscowosc.`ID`=uzytkownicy.`Miejscowosc`
              JOIN powiat ON `powiat`.`NrPowiatu`=`miejscowosc`.`Powiat` && `powiat`.`Wojewodztwo`=`miejscowosc`.`Wojewodztwo`
              JOIN wojewodztwo ON wojewodztwo.`TERYT`=miejscowosc.`Wojewodztwo`
           WHERE `uzytkownicy`.`ID`=$id";
        if ($wynik = $baza->query($uzytkownikQuery)) {
            $wynik = $wynik->fetch_assoc();
            $this->id = $id;
            $this->login = $wynik['Login'];
            $this->imie = $wynik['Imie'];
            $this->nazwisko = $wynik['Nazwisko'];
            $this->miejscowosc = $wynik['Miejscowosc'];
            $this->wojewodztwo = $wynik['Wojewodztwo'];
            $this->powiat = $wynik['Powiat'];
            $this->plec = $wynik['Plec'];
            $this->avatar = null;
        } else {
            echo $baza->error;
            print_r($wynik);
        }
    }
}
