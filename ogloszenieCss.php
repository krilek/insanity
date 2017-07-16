  #zdjecia img {
    height: 128px;
  }

  #slider {
    height: 128px;
  }

  #lewo {
    /*float: left;*/
    position: absolute;
    left: 0px;
    width: 40px;
    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#000000+31,000000+17,000000+38,000000+36,000000+76&0.65+20,0.45+62,0.15+89,0+100 */
    background: -moz-linear-gradient(left, rgba(0, 0, 0, 0.65) 17%, rgba(0, 0, 0, 0.65) 20%, rgba(0, 0, 0, 0.6) 31%, rgba(0, 0, 0, 0.58) 36%, rgba(0, 0, 0, 0.57) 38%, rgba(0, 0, 0, 0.45) 62%, rgba(0, 0, 0, 0.29) 76%, rgba(0, 0, 0, 0.15) 89%, rgba(0, 0, 0, 0) 100%);
    /* FF3.6-15 */
    background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0.65) 17%, rgba(0, 0, 0, 0.65) 20%, rgba(0, 0, 0, 0.6) 31%, rgba(0, 0, 0, 0.58) 36%, rgba(0, 0, 0, 0.57) 38%, rgba(0, 0, 0, 0.45) 62%, rgba(0, 0, 0, 0.29) 76%, rgba(0, 0, 0, 0.15) 89%, rgba(0, 0, 0, 0) 100%);
    /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to right, rgba(0, 0, 0, 0.65) 17%, rgba(0, 0, 0, 0.65) 20%, rgba(0, 0, 0, 0.6) 31%, rgba(0, 0, 0, 0.58) 36%, rgba(0, 0, 0, 0.57) 38%, rgba(0, 0, 0, 0.45) 62%, rgba(0, 0, 0, 0.29) 76%, rgba(0, 0, 0, 0.15) 89%, rgba(0, 0, 0, 0) 100%);
    /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6000000', endColorstr='#00000000', GradientType=1);
    /* IE6-9 */
    /*display: inline-block;*/
  }

  .jumbotron {
    background-color: #dff0d8;
    border-color: #d6e9c6;
    color: #468847;
    padding: 10px;
    margin-bottom: 0px;
  }
  /*#zdjecia {
  position: absolute;
  left: 20px;
  white-space: nowrap;
  overflow: hidden;
  width: calc(100% - 40px);
  z-index: 1;
}*/

  #zdjecia {
    /*float: left;*/
    position: absolute;
    left: 20px;
    white-space: nowrap;
    overflow-x: scroll;
    /*margin-left: 42px;
        margin-right: 42px;*/
    width: calc(100% - 40px);
    z-index: 1;
  }

  #zdjecia .thumbnail {
    display: inline-block;
    margin-bottom: 0px;
  }

  .thumbnail {
    display: inline-block !important;
  }

  #zdjecia img {
    height: 118px;
    max-width: 300px;
  }

  #prawo {
    /*float: left;*/
    /*display: inline-block;*/
    position: absolute;
    right: 0px;
    width: 40px;
    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#000000+24,000000+64,000000+62,000000+83,000000+69&0+0,0.15+11,0.45+38,0.65+80 */
    background: -moz-linear-gradient(left, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.15) 11%, rgba(0, 0, 0, 0.29) 24%, rgba(0, 0, 0, 0.45) 38%, rgba(0, 0, 0, 0.56) 62%, rgba(0, 0, 0, 0.57) 64%, rgba(0, 0, 0, 0.6) 69%, rgba(0, 0, 0, 0.65) 80%, rgba(0, 0, 0, 0.65) 83%);
    /* FF3.6-15 */
    background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.15) 11%, rgba(0, 0, 0, 0.29) 24%, rgba(0, 0, 0, 0.45) 38%, rgba(0, 0, 0, 0.56) 62%, rgba(0, 0, 0, 0.57) 64%, rgba(0, 0, 0, 0.6) 69%, rgba(0, 0, 0, 0.65) 80%, rgba(0, 0, 0, 0.65) 83%);
    /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to right, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.15) 11%, rgba(0, 0, 0, 0.29) 24%, rgba(0, 0, 0, 0.45) 38%, rgba(0, 0, 0, 0.56) 62%, rgba(0, 0, 0, 0.57) 64%, rgba(0, 0, 0, 0.6) 69%, rgba(0, 0, 0, 0.65) 80%, rgba(0, 0, 0, 0.65) 83%);
    /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#a6000000', GradientType=1);
    /* IE6-9 */
  }

  #zdjecia-row {
    margin-top: 10px;
    position: relative;
    margin-bottom: 2px;
  }

  #uzytkownik-info h3 {
    margin-top: 0;
  }

  .slider-btn {
    height: 128px;
    text-align: center;
    z-index: 2;
    /*TODO: GRADIENT NAPRAWIĆ, POZYCJE*/
    color: white;
  }

  .slider-btn>span {
    line-height: 128px;
  }

  .slider-btn:hover {
    color: #888
  }

  @media (min-width: 768px) {
    #tlo {
      background-image: url("http://localhost/img/1.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: 0% 50%;
      height: 400px;
      -webkit-filter: blur(4px);
      -moz-filter: blur(4px);
      -o-filter: blur(4px);
      -ms-filter: blur(4px);
      filter: blur(4px);
      z-index: -1;
    }
    .container {
      margin-top: -400px;
    }
    #zdjecia-row {
      height: 400px;
    }
    #glowne-zdjecie {
      position: absolute;
      bottom: 0px;
      height: 256px;
      width: 256px;
    }
    #glowne-zdjecie img {
      height: 246px;
      width: 256px;
    }
    #slider {
      position: absolute;
      bottom: 0px;
      left: 271px;
      margin-left: 2px;
      width: calc(100% - 271px - 17px);
      height: 128px;
      background-color: rgba(0, 0, 0, 0.2);
    }
    #zdjecia {
      overflow: hidden;
    }
    #tytul {
      position: absolute;
      padding-left: 10px;
      margin-left: 2px;
      bottom: 128px;
      left: 271px;
      width: calc(100% - 271px - 17px);
      /*height: 128px;*/
      background-color: rgba(0, 0, 0, 0.2);
      color: white;
      min-height: 128px;
    }
    #tytul h1 {
      margin-top: 15px;
    }
  }
  /* Large devices (desktops, 992px and up) */

  @media (min-width: 992px) {}
  /* Extra large devices (large desktops, 1200px and up) */

  @media (min-width: 1200px) {}