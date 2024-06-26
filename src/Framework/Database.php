<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException, PDOStatement;

class Database
{
    private PDO $connection;
    private PDOStatement $stmt;
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

    public function query(string $query, array $params = []): Database
    {
        $this->stmt = $this->connection->prepare($query);

        $this->stmt->execute($params);

        return $this;
    }

    public function count()
    {
        return $this->stmt->fetchColumn();
    }
}
