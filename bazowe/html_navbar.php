<?php
if (basename($_SERVER['SCRIPT_FILENAME']) != 'index.php') {
    echo '<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">';
} else {
    echo '<div class="container">
  <nav class="navbar navbar-inverse">';
}
  echo '<div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      <a class="navbar-brand" href="'.ROOT.'">Brand</a>
    </div>

    <div class="collapse navbar-collapse" id="bs">';
    // echo '<ul class="nav navbar-nav">
    //     <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
    //     <li><a href="#">Link</a></li>
    //     <li class="dropdown">
    //       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
    //       <ul class="dropdown-menu" role="menu">
    //         <li><a href="#">Action</a></li>
    //         <li><a href="#">Another action</a></li>
    //         <li><a href="#">Something else {
    // here</a></li>
    //         <li class="divider"></li>
    //         <li><a href="#">Separated link</a></li>
    //         <li class="divider"></li>
    //         <li><a href="#">One more separated link</a></li>
    //       </ul>
    //     </li>
    //   </ul>
    //   <ul class="nav navbar-nav navbar-left">
    //     <li><a href="#">Link</a></li>
    //   </ul>';
if (isset($_SESSION['zalogowany'])) {
    echo '
                <ul class="nav navbar-nav navbar-right">
                  <li class="active"><a href="#"><span class="glyphicon glyphicon-user"></span> '.$_SESSION['login'].'</a></li>
                  <li><a href="'.OGLOSZENIA_KAT.'ogloszenia.php"><span class="glyphicon glyphicon-plus"></span> Dodaj ogłoszenie</a></li>
                  <li><a href="'.WIADOMOSCI_KAT.'wiadomosci.php'.'"><span class="glyphicon glyphicon-envelope"></span></a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-align-justify"></span></a></li>
                  <li><a href="'.UZYTKOWNIK_KAT.'wyloguj.php"><span class="glyphicon glyphicon-log-out"></span></a></li>
                </ul>';
} else {
    echo '
              <form class="navbar-form navbar-right" id="logowanie" role="logowanie" action="'.UZYTKOWNIK_KAT.'zaloguj.php" method="post">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Login" name="login">
                  <input type="password" class="form-control" placeholder="Hasło" name="haslo">
                </div>
                <button type="submit" class="btn btn-default">Zaloguj</button>
                <a class="btn btn-default" href="'.UZYTKOWNIK_KAT.'rejestracja.php'.'">Rejestracja</a>
              </form>
        ';
}
echo '</div>';
if (basename($_SERVER['SCRIPT_FILENAME']) != "index.php") {
    echo'</div>
 </nav>';
} else {
    echo    '</nav>
    </div>';
}
// FIXME: event collapse wtedy onResize
