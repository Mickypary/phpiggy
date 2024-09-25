<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use App\Config\Paths;
use Framework\App;
use Dotenv\Dotenv;
use function App\Config\{registerRoutes, registerMiddleware};

$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();

$app = new App(Paths::SOURCE . "App/container-definitions.php");
// $app = new App();

registerRoutes($app);
registerMiddleware($app);


return $app;
