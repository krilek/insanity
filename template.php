<?php
require_once("../config.php");
  session_start();
  $_SESSION['url'] = $_SERVER['REQUEST_URI'];
?>

<!doctype html>
<html lang="pl">
  <?php require_once(HEAD);?>
<body>
  <?php require_once(NAVBAR);?>
  <div class="container">
  </div>
  <?php require_once(FOOTER); ?>
</body>
</html>
