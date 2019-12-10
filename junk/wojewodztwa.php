<?php require_once("config.php");
header('Content-Type: text/html; charset=utf-8');
 $baza = new mysqli(SERVERNAME, USERNAME, PASSWORD, "testowa");
  mb_internal_encoding("UTF-8");
if ($baza->connect_error) {
    przekieruj(BLAD."?blad=100");
    die("Brak połączenia z bazą");
} else {
    $baza->set_charset("utf8");
}
?>
<!doctype html>

<html lang="pl">

<head>
  <meta charset="utf-8">

  <title>R</title>
  <meta name="description" content="ROPIS">
  <meta name="author" content="krilek">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-fix.css">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <a class="navbar-brand" href="#">Brand</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
          <li><a href="#">Link</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li class="divider"></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Link</a></li>
        </ul>
      </div>
    </div>
  </nav>
  </div>
  <div class="container">
    <div class="row">
          <div id="the-basics">
      <input class="typeahead" type="text" placeholder="States of USA">
    </div>
      <select id="wojewodztwa">
        <?php
          $wynik = $baza->query("SELECT * FROM wojewodztwa");
          // $wynik = $wynik->fetch_assoc();
        foreach ($wynik as $wiersz) {
            echo "<option value='".$wiersz['TERYT']."'>".$wiersz['Nazwa']."</option>";
            // echo $wiersz;
            // print_r($wiersz);
        }
        ?>
      </select>
    </div>
    <div class="row">
      <div class="input-group">
        <input type="text" class="form-control" id="wyszukaj">
        <div style="display: none" id="podpowiedz">

        </div>
      </div>
    </div>
  </div>
    <?php
    require_once(FOOTER);
    ?>
  <script>
  var wojewodztwo;
  var pow;
    $(document).ready(function (){
      $("#podpowiedz").hide();
    $("#wojewodztwa").on("change", function () {
      // console.log();
      wojewodztwo = $("#wojewodztwa option:selected").val();
      $.post("wojTesty.php",{
          teryt: wojewodztwo,
          tryb: "powiaty"},
        function (data, textStatus, jqXHR) {
          $("div.row").append(data);
          // console.log(data);
          $("#powiaty").on("change", selectPowiat);
        }
      );
    });
    console.log($("#wyszukaj"));
    $("#wyszukaj").on("input", function (){
      console.log("1");
      if($(this).val().length > 1){
       console.log("2");
       $.post("wojTesty.php",{
          szukaj: $(this).val(),
          tryb: "wyszukaj"},
        function (data, textStatus, jqXHR) {
          console.log(data);

          $("#podpowiedz").html(data);
          $("#podpowiedz").show();
        }
      );
      }else{
        $("#podpowiedz").hide();
        $("#podpowiedz").html("");
      }
    })
  });
  function selectPowiat(){
      pow = $("#powiaty option:selected").val();
      $.post("wojTesty.php",{
          teryt: wojewodztwo,
          powiat: pow,
          tryb: "miasta"},
        function (data, textStatus, jqXHR) {
          console.log(data);
          $("div.row").append(data);
        }
      );
    }
  </script>
</body>

</html>
