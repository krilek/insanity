<?php
  function nawigacja()
  {
      require_once(BAZA);
      $zapytanie = "SELECT * FROM wojewodztwa";
      $wynik = $baza->query($zapytanie);
      echo '<ul class="nav nav-pills nav-stacked">';
      if ($wynik->num_rows > 0) {
          foreach ($wynik as $wiersz) {
              echo '<li><a onclick="woj_wybor('.$wiersz['ID'].')" href="#">';
              echo $wiersz['Nazwa'];
              echo '</a></li>';
          }
      }
      echo '</ul>';
      $baza->close();
  }
  function lista()
  {
      require_once(BAZA);
      $zapytanie = "SELECT * FROM wojewodztwa";
      $wynik = $baza->query($zapytanie);
      if ($wynik->num_rows > 0) {
          foreach ($wynik as $wiersz) {
              echo "<option value='".$wiersz['ID']."'>";
              echo $wiersz['Nazwa'];
              echo '</option>';
          }
      }
      echo '</ul>';
      $baza->close();
  }
