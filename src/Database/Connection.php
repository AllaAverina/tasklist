<?php

namespace Database;

use PDO;

class Connection
{
    public PDO $pdo;
    private static $instance;

    public function __construct()
    {
        $config = (require_once __DIR__ . '/../../config/config.php')['db'];

        $this->pdo = new PDO(
            'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=utf8mb4;',
            $config['user'],
            $config['password'],
            [
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_STRINGIFY_FETCHES => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    public static function getInstance(): object
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function runQuery(string $sql, $params = []): object|false
    {
        if (!$params) {
            return $this->pdo->query($sql);
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function getRow(string $sql, string $class = null, array $params = []): mixed
    {
        if ($class) {
            return $this->runQuery($sql, $params)->fetchObject($class);
        }
        return $this->runQuery($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    public function getColumn(string $sql, array $params = []): mixed
    {
        return $this->runQuery($sql, $params)->fetchColumn();
    }

    public function getRows(string $sql, string $class = null, array $params = []): array
    {
        if ($class) {
            return $this->runQuery($sql, $params)->fetchAll(PDO::FETCH_CLASS, $class);
        }
        return $this->runQuery($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }
}
