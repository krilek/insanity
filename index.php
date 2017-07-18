<?php
  require_once("config.php");
  require_once(SESJA);
?>

  <!doctype html>

  <html lang="pl">
    <?php require_once(HEAD);?>
    <link rel="stylesheet" href="./css/typeahead.css">
  <style>
    .thumbnail {
      /*
      "Thumbnail Caption Hover Effect"
      Snippet by MechanisM
      Copyright (c) 2013 Bootsnipp.com
      */
      position: relative;
      height: 188px;
      background: #efefef;
    }

    .thumbnail img {
      max-height: 178px;
      width: 100%;
      object-fit: cover;
      object-position: 50% 50%;
    }

    .btn-block {
      display: block;
    }

    .btn-block button {
      width: 100%;
    }


    .cena,
    .cena-tlo {
      position: absolute;
      bottom: 2px;
      right: 2px;
      padding: 2px 4px 4px 4px;
      white-space: nowrap;
      color: white;
    }

    .cena-tlo {
      background-color: rgba(92, 32, 64, 0.75);
      -webkit-filter: blur(4px);
      -moz-filter: blur(4px);
      -o-filter: blur(4px);
      -ms-filter: blur(4px);
      filter: blur(4px);
    }

    .caption {
      position: absolute;
      top: 0;
      right: 0;
      background: rgba(92, 32, 64, 0.75);
      width: 100%;
      height: 100%;
      padding: 2%;
      display: none;
      text-align: center;
      color: #fff !important;
      z-index: 2;
    }

    @media only screen and (min-width: 768px) {
      .reset-padding {
        padding-left: 2px;
        padding-right: 2px;
      }
      .thumbnail {
        /*
      "Thumbnail Caption Hover Effect"
      Snippet by MechanisM
      Copyright (c) 2013 Bootsnipp.com
      */
        height: 158px;
      }

      .thumbnail img {
        max-height: 148px;
      }
      .btn-block {
        display: table;
      }
    }
  </style>

  <body>
    <?php require_once(NAVBAR);?>
    <div class="container">
        <?php include_once(I_BAZOWY_KAT."szukajPodpowiedzi.php");
        echo szukajDiv(); ?>
    </div>
    <!--FIXME: DROPDOWN do poprawienia dodać możliwość wyszukiwania w kategorii i mieście-->
    
    <!--<div class="jumbotron ">
      XD
    </div>-->
    <div class="container ">
      <div class="row ">
        <div class="col-sm-12 ">
          <div class="page-header ">
            <h2>
              Najnowsze
            </h2>
          </div>
          <div class="row ">
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      <div class="row ">
        <div class="col-sm-12 ">
          <div class="page-header ">
            <h2>
              Najpopularniejsze
            </h2>
          </div>
          <div class="row ">
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      <div class="row ">
        <div class="col-sm-12 ">
          <div class="page-header ">
            <h2>
              W twoim regionie
            </h2>
          </div>
          <div class="row ">
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
      <div class="row ">
        <div class="col-sm-12 ">
          <div class="page-header ">
            <h2>
              Ostatnio przeglądane
            </h2>
          </div>
          <div class="row ">
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-lg-2 col-sm-4 reset-padding ">
              <div class="thumbnail ">
                <div class="caption ">
                  <h4>Thumbnail Headline</h4>
                  <p>short thumbnail description</p>
                  <p><a href=" " class="label label-danger " rel="tooltip " title="Zoom ">Zoom</a>
                    <a href=" " class="label label-default " rel="tooltip " title="Download now ">Download</a></p>
                </div>
                <img class="img-responsive " src="http://placehold.it/500x500 " alt="... ">
                <div class="cena-tlo ">
                  173213123333,32 PLN
                </div>
                <div class="cena ">
                  173213123333,32 PLN
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
    <?php require_once(FOOTER); ?>
    <script src="./js/typeahead.bundle.min.js"></script>
    <script>
      $(document).ready(function () {
        $("[rel='tooltip' ] ").tooltip();

        $('.thumbnail').hover(
          function () {
            $(this).find('.caption').fadeIn(250)
          },
          function () {
            $(this).find('.caption').fadeOut(205)
          }
        );
      });
// constructs the suggestion engine
      
      var ogloszenia = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: <?php echo "'".BAZOWY_KAT."szukajPodpowiedzi.php?tabela=ogloszenia&q=%QUERY',";?>
          wildcard: '%QUERY',
          cache: true
        }
      });
      $('#wyszukiwarka').typeahead({
        hint: true,
        highlight: true,
        minLength: 2
      }, {
        name: 'ogloszenia',
        source: ogloszenia
      });
      
      var miejscowosc = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: <?php echo "'".BAZOWY_KAT."szukajPodpowiedzi.php?tabela=miejscowosc&q=%QUERY',";?>
          wildcard: '%QUERY',
          cache: true
        }
      });
      $('#wyszukiwarka-miejscowosc').typeahead({
        hint: true,
        highlight: true,
        minLength: 2
      }, {
        name: 'miejscowosc',
        source: miejscowosc
      });


      // https://twitter.github.io/typeahead.js/examples/#multiple-datasets
      //https://stackoverflow.com/questions/23510474/typeahead-js-with-clickable-links
      // https://stackoverflow.com/questions/30118217/how-to-get-output-from-php-to-typeahead
      // https://github.com/twitter/typeahead.js/blob/master/doc/bloodhound.md#prefetch
    </script>
  </body>

  </html>
