<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use App\Infrastructure\Database\DTO\WhereConditionDTO;

class Query
{
    public function __construct(private Connection $connection, private QueryBuilder $builder)
    {
    }

    /**
     * @var array<int, string>
     */
    private array $select = [];

    /**
     * @var array<int, WhereConditionDTO>
     */
    private array $where = [];

    /**
     * @var array<int, array{0:string, 1:string, 2:string}>
     */
    private array $join = [];
    private ?string $from = null;
    private ?string $orderBy = null;
    private ?int $limit = null;
    private ?int $offset = null;

    /**
     * @var array<string, mixed>
     */
    private array $params = [];

    protected function createCommand(): Command
    {
        $sql = $this
            ->builder
            ->build(
                select: $this->select,
                from: $this->from,
                where: $this->where,
                join: $this->join,
                order: $this->orderBy,
                limit: $this->limit,
                offset: $this->offset
            );

        return $this->connection->createCommand($sql, $this->params);
    }

    public function getResult(): array
    {
        return $this->createCommand()->queryAll();
    }

    public function getSingleResult(): ?array
    {
        return $this->createCommand()->queryOne();
    }

    public function select(string ...$select): self
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
        $this->where[] = new WhereConditionDTO(operator: null, condition: $condition);
        return $this;
    }

    public function andWhere(string $condition): self
    {
        $this->where[] = new WhereConditionDTO(operator: 'AND', condition: $condition);
        return $this;
    }

    public function orWhere(string $condition): self
    {
        $this->where[] = new WhereConditionDTO(operator: 'OR', condition: $condition);
        return $this;
    }

    public function innerJoin(string $tableName, string $condition): self
    {
        $this->join[] = ['INNER JOIN', $tableName, $condition];
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    public function orderBy(string $sort, ?string $order = null): self
    {
        $orderBy = $sort;

        if ($order !== null) {
            $orderBy .= ' ' . $order;
        }

        $this->orderBy = $orderBy;

        return $this;
    }

    public function resetOrderBy(): self
    {
        $this->orderBy = null;

        return $this;
    }

    public function resetLimit(): self
    {
        $this->limit = null;

        return $this;
    }

    public function resetOffset(): self
    {
        $this->offset = null;

        return $this;
    }

    public function addParameter(string $name, mixed $value): self
    {
        $this->params[$name] = $value;

        return $this;
    }
}
