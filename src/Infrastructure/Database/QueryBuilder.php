<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use App\Infrastructure\Database\DTO\WhereConditionDTO;

class QueryBuilder
{
    /**
     * @param array<int, string> $select
     * @param array<WhereConditionDTO> $where
     * @param array<int, array{0:string, 1:string, 2:string}> $join
     */
    public function build(
        array $select = [],
        ?string $from = null,
        array $where = [],
        array $join = [],
        ?string $order = null,
        ?int $limit = null,
        ?int $offset = null,
    ): string {
        $str = $this->buildSelect($select);
        $str .= $this->buildFrom($from);
        $str .= $this->buildJoin($join);
        $str .= $this->buildWhere($where);
        $str .= $this->buildOrder($order);
        $str .= $this->buildLimit($limit, $offset);

        return $str;
    }

    /**
     * @param array<WhereConditionDTO> $where
     */
    private function buildWhere(array $where = []): string
    {
        $condition = array_map(
            static fn (WhereConditionDTO $dto): string => sprintf(
                "%s %s",
                $dto->operator ?? ' WHERE',
                $dto->condition
            ),
            $where
        );

        return implode(' ', $condition);
    }

    /**
     * @param array<int, array{0:string, 1:string, 2:string}> $join
     */
    private function buildJoin(array $join = []): string
    {
        $condition = [];

        foreach ($join as $value) {
            $condition[] = sprintf("%s %s ON %s", $value[0], $value[1], $value[2]);
        }

        return $condition === [] ? '' : implode(' ', $condition);
    }

    private function buildLimit(?int $limit, ?int $offset): string
    {
        $str = $limit === null ? '' : ' LIMIT ' . $limit;
        $str .= $offset === null ? '' : ' OFFSET ' . $offset;

        return $str;
    }

    private function buildOrder(?string $order): string
    {
        return $order === null ? '' : ' ORDER BY ' . $order;
    }

    private function buildFrom(?string $tableName): string
    {
        if ($tableName === null) {
            throw new \RuntimeException('Table name cannot be null');
        }

        return sprintf(' FROM %s ', $tableName);
    }

    /**
     * @param array<int, string> $select
     */
    private function buildSelect(array $select = []): string
    {
        if ($select === []) {
            $select[] = "*";
        }

        return sprintf('SELECT %s', implode(', ', array_map(
            static fn (string $column): string => $column,
            $select
        )));
    }
}
