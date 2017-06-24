<?php
  session_start();
  // echo $_SERVER['REQUEST_URI'];
  // echo $_SESSION['url'];
  // if (!isset($_SESSION['url'])) {
      $_SESSION['url'] = $_SERVER['REQUEST_URI'];
  // } else {
  //     if ($_SERVER['REQUEST_URI'] != "/") {
  //         $_SESSION['url'] = $_SERVER['REQUEST_URI'];
  //     } else {
  //         $_SESSION['url'] = "";
  //     }
  // }
