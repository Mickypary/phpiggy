<?php
// print_r($_SERVER);
// phpinfo();
// print_r($_ENV);

include __DIR__ . '/../src/App/functions.php';

$app = include __DIR__ . '/../src/App/bootstrap.php';

$app->run();
