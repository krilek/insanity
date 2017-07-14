<?php
  require_once("../config.php");
  require_once(SESJA);
  require_once(FPOMOC);
  sprawdzZalogowany();
  require_once(BAZA);
  $tryb = "";
if (isset($_GET['wyswietl'])) {
    $tryb = $_GET['wyswietl'];
}
if (isset($_GET['ajax'])) {
    wyswietlListe($tryb);
    die();
}
?>

  <!doctype html>
  <html lang="pl">
    <?php require_once(HEAD);?>
  <style>
    .page-header {
      margin-top: 15px;
      margin-bottom: 10px;
    }

    .media-left img {
      width: 128px;
      height: 128px;
    }

    .nav-tabs.nav-justified {
      border-bottom: 1px solid #dddddd;
      margin-bottom: 15px;
    }

    .nav-tabs a {
      cursor: pointer;
    }

    .media {
      border-bottom: 1px solid #dddddd;
      position: relative;
    }

    .labele::before {
      content: " ";
    }

    .cena::after {
      content: " PLN";
    }

    @media (min-width: 768px) {
      .nav-tabs.nav-justified>li>a {
        border-bottom: none;
      }
    }

    .labele {
      display: inline;
    }

    .btn-control {
      position: absolute;
      right: 0px;
      bottom: 0px;
    }

    .media-body {
      padding-bottom: 33px;
    }
  </style>

  <body>
    <?php require_once(NAVBAR);?>
    <div class="container">
      <div class="row hidden-xs">
        <div class="col-sm-12">
          <div class="page-header">
            <h1>Ogłoszenia</h1>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <ul class="nav nav-tabs nav-justified">
            <li role="presentation"><a href="dodaj_ogloszenie.php">Dodaj</a></li>
            <li role='presentation' <?php echo ($tryb=="" ? "class='active'" : "")?>><a onclick="wyswietlListe({input:'',anchor:this})">Wszystkie</a></li>
            <li role="presentation" <?php echo ($tryb=="aktywne" ? "class='active'" : "")?>><a onclick="wyswietlListe({input:'aktywne',anchor:this})">Aktywne</a></li>
            <li role="presentation" <?php echo ($tryb=="zakonczone" ? "class='active'" : "")?>><a onclick="wyswietlListe({input:'zakonczone',anchor:this})">Zakończone</a></li>
            <li role="presentation" class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                Wyszukaj<span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                ...
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12" id="lista">

            <?php
              wyswietlListe($tryb);
            ?>
        </div>
      </div>
    </div>
    <?php require_once(FOOTER); ?>
    <script>
      var aktualny = {
        input: sprawdzURL(),
        anchor: $(".nav-tabs li[class='active'] a")
      };

      function wyswietlListe(obj) {
        if (obj.input != aktualny.input) {
          // console.log();

          $.get("ogloszenia.php", {
            wyswietl: obj.input,
            ajax: 1
          }, function (data, status) {
            // console.log($(aktualny.anchor).parent());
            $(aktualny.anchor).parent().toggleClass("active");
            $(obj.anchor).parent().toggleClass("active");
            $("#lista").html(data);
            aktualny = obj
          });
        }
      }

      function sprawdzURL() {
        var url_string = window.location.href;
        var url = new URL(url_string);
        var wyswietl = url.searchParams.get("wyswietl");
        if (!wyswietl) {
          wyswietl = "";
        }
        return wyswietl;
      }
    </script>
  </body>

  </html>

    <?php








    function wyswietlOgloszenie($tytul, $zdjecie, $tresc, $kategoria, $data, $typ, $typInfo, $cena = 0)
    {
        echo "<div class='media'>";
        echo "<div class='media-left'>";
          echo     "<a href='#'>";
        
        if ($zdjecie != "" && file_exists(I_IMG_OGLOSZENIA.$zdjecie)) {
            echo "<img class='media-object' src='".IMG_OGLOSZENIA.$zdjecie."' alt='$tytul'>";
        } else {
            echo "<img class='media-object' src='".IMG_KAT."brakZdjecia.png' alt='$tytul'>";
        }
          echo "</a>";
        echo "</div>";
        echo "<div class='media-body'>";
            echo "<h4 class='media-heading'>";
              echo "$tytul";
              //FIXME: POPRAWIĆ POZYCJE TYCH LABELI  np przy zmniejszaniu szerokości
              echo "<div class='labele'>";
              echo "<span class='label label-info'>$typ</span>";
        if ($typInfo == 1) {
            //TODO: dodać tłumaczenie na polskie ceny
            echo "<span class='label label-info cena'>$cena</span>";
        }
            echo "</div>";
            echo "</h4>";
            echo "<p>";
              echo "$tresc";
            echo "</p>";
            //FIXME: dodać kategorie
            echo "<div class='btn-group btn-control' role='group' aria-label='...'>";
              echo "<a href='#' class='btn btn-default'>Left</a>";
              echo "<a href='#' class='btn btn-default'>Middle</a>";
              echo "<a href='#' class='btn btn-default'><span class='glyphicon glyphicon-trash'></span></a>";
            echo "</div>";
        echo "</div>";
          echo "</div>";
    }
    function wyswietlListe($ktora, $wyszukaj = "")
    {
        global $baza;
          $uzytkownik = $_SESSION['idUzytkownika'];
              $zapytanie = "SELECT 
                                ogloszenia.ID,ogloszenia.Tytul, 
                                IF(LENGTH(ogloszenia.Tresc) > 450, CONCAT(LEFT(ogloszenia.Tresc, 450), '...'), ogloszenia.Tresc) AS Tresc,
                                ogloszenia.Cena,
                                kategorie.Nazwa as Kategoria, typogloszenia.Nazwa as Typ,
                                typogloszenia.CenaPotrzebna, Zdjecia.NazwaPliku, ogloszenia.DataUtworzenia
                                FROM ogloszenia 
                                  JOIN kategorie ON `kategorie`.ID = `ogloszenia`.Kategoria 
                                  JOIN typogloszenia ON `typogloszenia`.ID = `ogloszenia`.Typ 
                                  LEFT JOIN (SELECT * FROM zdjecia GROUP BY zdjecia.Ogloszenie) AS zdjecia ON Ogloszenia.ID = Zdjecia.Ogloszenie
                            WHERE `Uzytkownik` = $uzytkownik ";
        switch ($ktora) {
            case 'aktywne':
                $zapytanie .= "&& `Zakonczona` = 0 ";
                break;
            case 'zakonczone':
                $zapytanie .= "&& `Zakonczona` = 1 ";
                break;
        }
        $zapytanie.= "ORDER BY DataUtworzenia DESC ";
        // echo $zapytanie."<br>";
        $ogloszenia = $baza->query($zapytanie);
        // echo $baza->error;
        //JOIN hasla ON hasla.ID = uzytkownicy.ID
        if ($ogloszenia->num_rows > 0) {
            foreach ($ogloszenia as $ogloszenie) {
                wyswietlOgloszenie($ogloszenie['Tytul'], $ogloszenie['NazwaPliku'],
                                   $ogloszenie['Tresc'], $ogloszenie['Kategoria'],
                                   $ogloszenie['DataUtworzenia'], $ogloszenie['Typ'],
                                   $ogloszenie['CenaPotrzebna'], $ogloszenie['Cena']  );
            }
            //wyswietl
        } else {
            echo "<h2>Brak ogłoszeń</h2>";
        }
    }
