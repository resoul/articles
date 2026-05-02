<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use PDO;
use PDOException;

class Connection
{
    private ?PDO $pdo;

    public function __construct(
        private readonly string $dsn,
        private readonly string $username,
        private readonly string $password,
    ) {
    }

    public function open(): void
    {
        try {
            $this->pdo = new PDO($this->dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new \RuntimeException('Could not create database connection: ' . $e->getMessage());
        }
    }

    public function close(): void
    {
        $this->pdo = null;
    }

    public function getInstance(): ?PDO
    {
        return $this->pdo;
    }

    /**
     * @param array<string, int|string> $params
     */
    public function createCommand(string $sql, array $params = []): Command
    {
        return (new Command($this, $sql))->bindValues($params);
    }
}
