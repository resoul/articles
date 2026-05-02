<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

class Query
{
    public function __construct(private Connection $connection, private QueryBuilder $builder)
    {
    }

    private array $select = [];
    private array $where = [];
    private ?string $from = null;
    private array $params = [];

    protected function createCommand(): Command
    {
        $sql = $this->builder->build($this->select, $this->from, $this->where);

        return $this->connection->createCommand($sql, $this->params);
    }

    public function getResult(): array
    {
        return $this->createCommand()->queryAll();
    }

    public function select(...$select): self
    {
        $this->select = $select;
        return $this;
    }

    public function from(string $tableName): self
    {
        $this->from = $tableName;
        return $this;
    }

    public function where(string $condition): self
    {
        $this->where[] = ['', $condition];
        return $this;
    }

    public function andWhere(string $condition): self
    {
        $this->where[] = ['AND', $condition];
        return $this;
    }

    public function orWhere(string $condition): self
    {
        $this->where[] = ['OR', $condition];
        return $this;
    }

    public function addParameter(string $name, string|int $value): self
    {
        $this->params[$name] = $value;

        return $this;
    }
}