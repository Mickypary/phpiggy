<?php

$driver = "mysql";
$host = "localhost";
$dbname = "phpiggy";
$config = http_build_query(data: [
    'host' => 'localhost',
    'port' => 3306,
    'dbname' => 'phpiggy',
], arg_separator: ';');

// $dsn = "{$driver}:{$config}";
$dsn = "{$driver}:{$host};{$dbname}";
$username = 'root';
$password = '';

$db = new PDO($dsn, $username, $password);

var_dump($db);
