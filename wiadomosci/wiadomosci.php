<?php
require_once("../config.php");
  require_once(SESJA);
?>

<!doctype html>
<html lang="pl">
  <?php require_once(HEAD);?>
  <style>
  #ludzie{
    min-height: 200px;
    overflow-y: scroll;
    height: 60vh;
  }
  @media screen and (max-width: 768px) {
    #ludzie{
      height: 20vh;
    }
  }
  #chat{
    position: relative;
    min-height: 400px;
    height: 60vh;
  }
  #chat .input-group{
    position: absolute;
    bottom: 0px;
  }
  .panel-body{
    position: absolute;
    bottom: 39px;
    top: 42px;
    /*max-height: calc(60vh - 80px);*/
    overflow-y: scroll;
    overflow-x: hidden;
  }
  .media-right img{
    width: 100%;
    margin-bottom: 2px;
  }
  .media-left img{
    width: 100%;
    margin-bottom: 2px;
  }
  /*#chat .panel{
    height: 100%;
  }*/
  /*.przewijalne{
    height: 100%;
    overflow-y: scroll;
  }
  .przewijalne li{
    margin-right: 2px;
  }*/

  </style>
<body>
  <?php require_once(NAVBAR);?>
  <div class="container">
      <div class="page-header">
  <h1>Wiadomości</h1>
</div>
    <div class="row">
      <div class="col-sm-4">
        <ul class="list-group" id="ludzie">
          <li class="list-group-item">Cras justo odio</li>
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Morbi leo risus<span class="badge">321</span></li>
          <li class="list-group-item">Cras justo odio</li>
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Morbi leo risus<span class="badge">321</span></li>
          <li class="list-group-item">Cras justo odio</li>
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Morbi leo risus<span class="badge">321</span></li>
          <li class="list-group-item">Cras justo odio</li>
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Morbi leo risus<span class="badge">321</span></li>
          <li class="list-group-item">Cras justo odio</li>
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Morbi leo risus<span class="badge">321</span></li>
        </ul>
      </div>
      <div class="col-sm-8">
        <div id="chat">
          <div class="panel panel-default">
            <div class="panel-heading">Rozmówca</div>
            <div class="panel-body">
              <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
                    </a>
                    <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
                  </div>
                  <div class="media-body">
                    <p>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                    </p>
                  </div>
                </div>
              <div class="media">
                  <div class="media-body">
                    <p>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                    </p>
                  </div>
                  <div class="media-right">
                    <a href="#">
                      <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
                    </a>
                    <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
                  </div>
                </div>
              <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
                    </a>
                    <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
                  </div>
                  <div class="media-body">
                    <p>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                    </p>
                  </div>
                </div>
              <div class="media">
                  <div class="media-body">
                    <p>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                    </p>
                  </div>
                  <div class="media-right">
                    <a href="#">
                      <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
                    </a>
                    <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
                  </div>
                </div>
              <div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
                    </a>
                    <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
                  </div>
                  <div class="media-body">
                    <p>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                    </p>
                  </div>
                </div>
              <div class="media">
                  <div class="media-body">
                    <p>
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                    </p>
                  </div>
                  <div class="media-right">
                    <a href="#">
                      <img class="media-object img-circle" src="http://placehold.it/32x32" alt="...">
                    </a>
                    <span class="label label-info" data-toggle="tooltip" data-placement="top" title="24.06.2017">13:48</span>
                  </div>
                </div>
            </div>
          </div>
          <!-- INPUT -->
          <div class="input-group">
            <input type="text" class="form-control" aria-label="...">
            <div class="input-group-btn">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
              <button type="button" class="btn btn-default" aria-haspopup="true" aria-expanded="false">Action</button>
              <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once(FOOTER); ?>
</body>
</html>
