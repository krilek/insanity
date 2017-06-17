<?php include_once("config.php");
header('Content-Type: text/html; charset=utf-8');?>
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
      <div class="col-sm-3">
        <h3>Wybierz województwo</h3>
        <?php include(WOJEWODZTWA); ?>
        <ul class="nav nav-pills nav-stacked">
          <li><a href="#">Profile</a></li>

          <li class="active"><a href="#">Home</a></li>
          <!-- <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              Dropdown <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </li> -->
        </ul>
      </div>
      <div class="col-sm-9">
        <div class="row">
          <div class="col-sm-12">
            <h2>Najnowsze</h2>
            <div class="col-xs-6 col-sm-4 col-md-3">
              <a class="thumbnail">
                <img src="http://placehold.it/200x300" />
                <div class="caption">
                  <p>Lorem ipsum...</p>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <h2>Najpopularniejsze</h2>
            <div class="col-xs-6 col-sm-4 col-md-3">
              <a class="thumbnail">
                <img src="http://placehold.it/200x300" />
                <div class="caption">
                  <p>Lorem ipsum...</p>
                </div>
              </a>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <h2>W twoim regionie</h2>
            <div class="col-xs-6 col-sm-4 col-md-3">
              <a class="thumbnail">
                <img src="http://placehold.it/200x300" />
                <div class="caption">
                  <p>Lorem ipsum...</p>
                </div>
              </a>
            </div>

          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <h2>Ostatnio przeglądane</h2>
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
          <a class="thumbnail">
            <img src="http://placehold.it/200x300" />
            <div class="caption">
              <p>Lorem ipsum...</p>
            </div>
          </a>
        </div>

      </div>
    </div>

  </div>
  <script src="js/jquery-3.2.1.min.js"></script>
</body>

</html>
