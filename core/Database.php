<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    private $host;
    private $port;
    private $dbName;
    private $username;
    private $password;
    private $pdo;

    public function __construct()
    {
        $this->host = getenv('DB_HOST') ?? '127.0.0.1';
        $this->port = getenv('DB_PORT') ?? '3306';
        $this->dbName = getenv('DB_NAME') ?? 'database';
        $this->username = getenv('DB_USER') ?? 'root';
        $this->password = getenv('DB_PASSWORD') ?? '';

        $this->connect();
    }

    private function connect()
    {
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->dbName}";
            $this->pdo = new PDO($dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}
