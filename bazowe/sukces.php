<?php
require_once("../config.php");
  require_once(SESJA);
?>

<!doctype html>
<html lang="pl">
    <?php require_once(HEAD);?>
<body>
    <?php require_once(NAVBAR);?>
  <div class="container">
    <div class="jumbotron text-center">
        <h2>Rejestracja przebiegła pomyślnie.</h2>
        <p>Na podany email wysłany został link aktywacyjny.
        Kliknij w niego aby kontynuować.</p>
      </div>
  </div>
    <?php require_once(FOOTER); ?>
</body>
</html>
