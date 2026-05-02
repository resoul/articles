<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use PDO;
use PDOStatement;

class Command
{
    private PDOStatement $statement;

    public function __construct(Connection $connection, string $sql)
    {
        $this->statement = $connection->getInstance()->prepare($sql);
    }

    /**
     * @param array<string, int|string> $params
     */
    public function bindValues(array $params = []): self
    {
        foreach ($params as $name => $value) {
            $this->bindValue($name, $value);
        }

        return $this;
    }

    public function bindValue(string $name, int|string $value): self
    {
        $filteredName = str_starts_with($name, ':') ? $name : ':' . $name;
        $this->statement->bindValue($filteredName, $value);

        return $this;
    }

    public function execute(): bool
    {
        return $this->statement->execute();
    }

    public function queryColumn(): array
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function queryAll(): array
    {
        $this->execute();
        return $this->statement->fetchAll();
    }

    public function queryOne(): array
    {
        $this->execute();
        return $this->statement->fetch();
    }

    public function queryScalar(): mixed
    {
        $this->execute();
        $result = $this->statement->fetchColumn();
        return $result === false ? null : $result;
    }
}
