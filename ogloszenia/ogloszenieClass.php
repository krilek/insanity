<?php
class Ogloszenie
{
    public $id;
    public $zdjecia = array();
    public $tytul;
    public $tresc;
    public $uzytkownik;
    public $kategoria;
    public $typOgloszenia;
    public $zakonczona;
    public $dataUtworzenia;
    public $dataModyfikacji;
    public $cenaPotrzebna;
    public $ilZdjec;
    public $saZdjecia = false;
    public $admin = false;
    public function __construct($getID)
    {
        global $baza;
        $this->id = $baza->escape_string($getID);
    }
    function znajdzOgloszenie()
    {
        global $baza;
        $ogloszenieQuery = 'SELECT 
                              `ogloszenia`.`Uzytkownik`, `ogloszenia`.`Tytul`, 
                              `kategoria`.`Nazwa` AS Kategoria,`typogloszenia`.`Nazwa` AS Typ,
                              `ogloszenia`.`Zakonczona`,`ogloszenia`.`Tresc`,
                              REPLACE(CAST(`ogloszenia`.`Cena` AS CHAR), ".", ",") AS Cena,
                              `ogloszenia`.`DataUtworzenia`,
                              `ogloszenia`.`DataModyfikacji`, `typogloszenia`.`CenaPotrzebna`
                              FROM ogloszenia
                              JOIN typogloszenia ON `typogloszenia`.`ID` = `ogloszenia`.`Typ`
                              JOIN kategoria ON `kategoria`.ID = `ogloszenia`.`Kategoria`
                            WHERE `ogloszenia`.`ID`= '.$this->id;
        $wynik = $baza->query($ogloszenieQuery);
        if ($wynik->num_rows > 0) {
            $wynik = $wynik->fetch_assoc();
            $this->tytul = $wynik['Tytul'];
            $this->tresc = $wynik['Tresc'];
            $this->uzytkownik = $wynik['Uzytkownik'];
            $this->kategoria = $wynik['Kategoria'];
            $this->typOgloszenia = $wynik['Typ'];
            $this->zakonczona = boolval($wynik['Zakonczona']);
            $this->dataUtworzenia = $wynik['DataUtworzenia'];
            $this->dataModyfikacji = $wynik['DataModyfikacji'];
            $this->cenaPotrzebna = boolval($wynik['CenaPotrzebna']);
            return true;
        } else {
          //Nie istnieje
            return false;
        }
    }
    function znajdzZdjecia()
    {
        global $baza;
        $zdjeciaQuery = "SELECT NazwaPliku FROM zdjecia WHERE Ogloszenie=$this->id";
        $wynik = $baza->query($zdjeciaQuery);
        if ($wynik->num_rows > 0) {
            foreach ($wynik as $zdjecie) {
                if (file_exists(I_IMG_OGLOSZENIA.$zdjecie['NazwaPliku'])) {
                    array_push($this->zdjecia, $zdjecie['NazwaPliku']);
                    $this->ilZdjec++;
                    $this->saZdjecia = true;
                }
            }
            return $this->saZdjecia;
        }
        return false;
    }
    function sprawdzCzyAdmin($idZalogowanego)
    {
        if ($idZalogowanego == $this->uzytkownik) {
            $this->admin = true;
        }
    }
    function zwrocGlowneZdjecie()
    {
        return "<div id='glowne-zdjecie' class='hidden-xs'>
              <a class='thumbnail'>
                    <img src='".IMG_OGLOSZENIA.$this->zdjecia[0]."'>
                  </a>
            </div>";
    }
    function zwrocTytul()
    {
        return "<div id='tytul'>
              <h1>$this->tytul</h1>
            </div>";
    }
    function zwrocSlider()
    {
        $slider = "<div id='slider'".($this->ilZdjec > 1 ? ""  : "class='visible-xs'").">
                    <div id='lewo' class='slider-btn'>
                        <span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>
                    </div>
                    <div id='zdjecia'>";
        foreach ($this->zdjecia as $zdjecie) {
            if (file_exists(I_IMG_OGLOSZENIA.$zdjecie)) {
                if ($zdjecie === reset($this->zdjecia)) {
                    $slider.= "<a class='thumbnail visible-xs'>";
                } else {
                    $slider.= "<a class='thumbnail'>";
                }
                $slider.= "<img src='".IMG_OGLOSZENIA.$zdjecie."'>";
                $slider.= "</a>";
            }
        }
            $slider.= "</div>
                       <div id='prawo' class='slider-btn'>
                          <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>
                       </div>
                    </div>";
            return $slider;
            // TODO: ZROBIĆ POZYCJONOWANIE PRAWEGO BUTTONA W ZALEŻNOŚCI O ILOŚCI ZDJĘĆ
    }
    function zwrocInformacjeUzytkownika($uzytkownik, $zalogowany)
    {
        $info =  "<div class='jumbotron' id='uzytkownik-info'>
        <div class='row'>
          <div class='col-xs-6 col-sm-3 col-md-2'>
            <a class='thumbnail' style='margin-bottom: 0px;'>
                <img style='height: 128px; width: 128px;' src='$uzytkownik->avatar'>
              </a>
          </div>
          <div class='col-xs-6 col-sm-4 col-md-5'>
            <h3>".$uzytkownik->imie." ".$uzytkownik->nazwisko."</h3>
            <p>".$uzytkownik->wojewodztwo.", ".$uzytkownik->miejscowosc."</p>
          </div>
          <div class='col-xs-12 col-sm-5'>
            <h3>Skontaktuj się</h3>
            <div class='btn-group'>
              <a href='".WIADOMOSCI_KAT."nowa_wiadomosc.php?adresat=".$uzytkownik->id."' class='btn btn-info".(!$zalogowany ? " disabled" : "")."'>Wiadomość <span class='glyphicon glyphicon-comment' aria-hidden='true'></span></a>
              <a href='#' class='btn btn-info'>Telefon <span class='glyphicon glyphicon-phone' aria-hidden='true'></span></a>
              <div class='btn-group'>
                <a href='#' class='btn btn-info dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                  Więcej
                  <span class='caret'></span>
                </a>
                <ul class='dropdown-menu'>
                  <li><a href='#'>Gadu-Gadu <span class='glyphicon glyphicon-asterisk' aria-hidden='true'></span></a></li>
                  <li><a href='#'>Poproś o email <span class='glyphicon glyphicon-envelope' aria-hidden='true'></span></a></li>
                  <li><a href='#'>Skype <i class='fa fa-skype' aria-hidden='true'></i></a></li>";
                //   <li class='divider'></li>
                //   <li><a href='#'>Separated link</a></li>
        $info .= "</ul>
              </div>
            </div>
            <div class='btn-group'>
              <a href='#' class='btn btn-danger'>Zgłoś naruszenie <span class='fa fa-flag' aria-hidden='true'></span></a>
            </div>
          </div>
        </div>
        </div>";
        return $info;
        //TODO: class disabled na elementach które wymagają zalogowania
    }
    function zwrocTresc()
    {
        //FIXME: Podejrzewam chujnie z enterami
        return "<div class='panel panel-default'>
            <div class='panel-body'>".
                nl2br($this->tresc)
            ."</div>
          </div>";
    }
    function zwrocInfoOgloszenia()
    {
        return "<div class='panel panel-info'>
            <div class='panel-heading'>
              <h3 class='panel-title'>".$this->kategoria."</h3>
            </div>
            <div class='panel-body'>
              Podkategoria
            </div>
          </div>";
    }
}
