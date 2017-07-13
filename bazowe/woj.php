<?php
  require_once(BAZA);
  function nawigacja()
  {
      global $baza;
      $zapytanie = "SELECT * FROM wojewodztwa";
      $wynik = $baza->query($zapytanie);
      if ($wynik) {
          echo '<div class="list-group">';
          if ($wynik->num_rows > 0) {
              foreach ($wynik as $wiersz) {
                  echo '<a href="#'.$wiersz['ID'].'" class="list-group-item">';
                  echo $wiersz['Nazwa'];
                  echo '</a>';
                  // echo '<li class="active"><a onclick="woj_wybor('..')" href="#">';
                  // echo '</a></li>';
              }
          } else {
              przekieruj(BLAD."?blad=32");
          }
          echo '</div>';
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
//TODO: PRZEBUDOWAĆ NA JEDNĄ FUNKCJE ZWRACAJĄCĄ ASSOC