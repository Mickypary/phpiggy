<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use App\Config\Paths;

// autoloading function 
use function App\Config\{registerRoutes, registerMiddleware};

// echo AboutController::class;

$app = new App(Paths::SOURCE . "App/container-definitions.php");

registerRoutes($app);
registerMiddleware($app);

// dd($app);

return $app;
