<?php

// phpinfo();

include __DIR__ . "/../src/App/functions.php";
// dd($_SERVER);
// ini_set("memory_limit", "255M");
// echo ini_get("memory_limit");


$app = include __DIR__ . "/../src/App/bootstrap.php";

$app->run();