<?php

$functions = [
  function ($next) {
    echo "A <br>";
    $next();
    echo "After Main Content";
  },

  function ($next) {
    echo "B <br>";
    $next();
  },

  function ($next) {
    echo "C <br>";
    $next();
  },
];


$a = function () {
  echo "Main Content <br>";
};

foreach ($functions as $function) {
  $a = fn() => $function($a);
  // $a();
  // die;
}

$a();
