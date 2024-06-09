<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException;

class Database
{
    private PDO $connection;
    public function __construct(string $driver, array $config, string $username, string $password)
    {
        // $host = "localhost";
        // $dbname = "phpiggy";
        $config = http_build_query(data: $config, arg_separator: ';');

        $dsn = "{$driver}:{$config}";
        // $dsn = "{$driver}:{$host};{$dbname}";

        try {
            $this->connection = new PDO($dsn, $username, $password);
        } catch (\PDOException $e) {
            die("Could not connect to the database {$e->getMessage()}");
        }
    }

    public function query(string $query)
    {
        $this->connection->query($query);
    }
}
