<?php
  echo '<script src="'.JS_KAT.'jquery-3.2.1.min.js"></script>';
  echo '<script src="'.JS_KAT.'bootstrap.min.js"></script>';
if (isset($rejestracja)) {
    echo '<script src="'.JS_KAT.'rejestracja.js?x='.rand(1, 10).'"></script>';
}
  // echo '<script src="'.JS_KAT.'navbar.fix.js?v='.time().'"></script>';
  echo '<script src="'.JS_KAT.'tooltip.js?v='.time().'"></script>';
