<?php
require_once("../config.php");
  require_once(SESJA);
  require_once(BAZA);
  require_once(FPOMOC);
  sprawdzZalogowany();
?>

<!doctype html>
<html lang="pl">
    <?php require_once(HEAD);?>
  <style>
    img{
      max-height: 150px;
      max-width: 150px;
    }
    textarea{
      max-width: 100%;
    }
    .oboksiebie{
      display: inline-block;
    }
    #podglad div{
      position: relative;
    }
    #podglad span{
      position: absolute;
      right: 4px;
      top: 4px;
      color: #772953;
    }
    #podglad span:hover{
      cursor: pointer;
    }
    .btn-file {
        margin-top: 5px;
        position: relative;
        overflow: hidden;
        display: block;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
    .nav-tabs{
    display: flex;
}
.nav-tabs li {
    display: flex;
    flex: 1;
}

.nav-tabs li  a {
    flex: 1;
}
  </style>
<body>
    <?php require_once(NAVBAR);?>
    <!--TODO: SESJA A TAM DANE z FORMULARZA ( DO STWORZENIA PODGLADU I POWROTU W CELU ZMIAN);-->
  <div class="container">
    <div class="page-header">
      <h1>Dodaj ogłoszenie</h1>
    </div>
    <form id="dodajOgloszenie" action="ogloszPost.php" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label for="tytul">Tytuł ogłoszenia:</label>
            <input type="tytul" class="form-control" id="tytul" name="tytul">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-10">
          <div class="form-group">
            <label for="kategoria">Kategoria:</label>
            <select class="form-control" id="kategoria" name="kategoria">
                <?php
                  $kategorie = $baza->query("SELECT ID, Nazwa FROM kategorie");
                foreach ($kategorie as $kategoria) {
                    echo '<option value="'.$kategoria['ID'].'">'.$kategoria['Nazwa'].'</option>';
                }
                ?>
            </select>
          </div>
          <div class="form-group">
            <label for="tresc">Treść ogłoszenia:</label>
            <textarea class="form-control" rows="5" id="tresc" name="tresc"></textarea>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label class="control-label" for="typ-oferty">Typ oferty:</label>
                <?php
                $typy = $baza->query("SELECT ID, Nazwa, CenaPotrzebna FROM typogloszenia");
                $checked = false;
                foreach ($typy as $typ) {
                    echo '<div class="radio">';
                    echo '<label>
                                <input type="radio" data-cena="'.$typ['CenaPotrzebna'].'" name="typ" value="'.$typ['ID'].'"';
                    if (!$checked) {
                        echo "checked";
                    } $checked = true;
                    echo            '>'.$typ['Nazwa'].'</label>';
                    echo '</div>';
                }
                ?>
          </div>
          <div class="input-group" id="cenaGrupa">
          <!-- TODO: ZROBIĆ WSZĘDZIE ARIA-->
            <input type="text" class="form-control" id="cena" name="cena" aria-label="">
            <span class="input-group-addon">Zł</span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-2">
          <div class="form-group">
            
            <label for="zdjecia">Zdjęcia:&nbsp;&nbsp;</label>
            <span class="label label-info" id="zdjeciaLicznik">Dodano 0 zdjęć</span>
            <span class="btn btn-default btn-file" id="zdjecia">Wybierz plik
                <div id="inputy">
                  <input type="file" name="zdjecia[]" cel="p1" accept="image/jpeg, image/png" onchange="czaryMary(this)">
                </div>
            </span>
          </div>
        </div>
        <div class="col-sm-10" id="podglad">
          <div id="p1" class="oboksiebie">
          </div>

        </div>
      </div>
      <button type="submit" class="btn btn-default">Dodaj ogłoszenie</button>
    </form>
  </div>
    <?php require_once(FOOTER); ?>
  <script src="file_input.js?v=<?php echo time(); ?>">
  
  </script>
</body>
</html>
