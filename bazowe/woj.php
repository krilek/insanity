<?php
  require_once(BAZA);
  function nawigacja()
  {
      global $baza;
      $zapytanie = "SELECT * FROM wojewodztwa";
      $wynik = $baza->query($zapytanie);
      if ($wynik) {
          echo '<ul class="nav nav-pills nav-stacked">';
          if ($wynik->num_rows > 0) {
              foreach ($wynik as $wiersz) {
                  echo '<li><a onclick="woj_wybor('.$wiersz['ID'].')" href="#">';
                  echo $wiersz['Nazwa'];
                  echo '</a></li>';
              }
          } else {
              przekieruj(BLAD."?blad=32");
          }
          echo '</ul>';
      }
      $wynik->free();
      $baza->close();
  }
  function lista()
  {
      global $baza;
      $zapytanie = "SELECT * FROM wojewodztwa";
      $wynik = $baza->query($zapytanie);
      if ($wynik) {
          if ($wynik->num_rows > 0) {
              foreach ($wynik as $wiersz) {
                  echo "<option value='".$wiersz['ID']."'>";
                  echo $wiersz['Nazwa'];
                  echo '</option>';
              }
          }
          echo '</ul>';
      } else {
          przekieruj(BLAD."?blad=32");
      }
      $wynik->free();
      $baza->close();
  }
