<?php

$check = require __DIR__ . "/vendor/autoload.php";

use App\Config\Paths;

// FOR DOTENV FILE CONFIG
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();

include __DIR__ .  "/src/Framework/Database.php";

use Framework\Database;

$db = new Database($_ENV['DB_DRIVER'], [
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'dbname' => $_ENV['DB_NAME'],
], $_ENV['DB_USER'], $_ENV['DB_PASS']);

$sqlFile = file_get_contents("./database.sql");

$db->query($sqlFile);
