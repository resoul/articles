<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

class QueryBuilder
{
    public function build(array $select = [], ?string $from = null, array $where = []): string
    {
        $str = $this->buildSelect($select);
        $str .= $this->buildFrom($from);
        $str .= $this->buildWhere($where);

        return $str;
    }

    private function buildWhere(array $where = []): string
    {
        $condition = [];
        foreach ($where as $value) {
            if ($value[0] === '') {
                $condition[] = sprintf("WHERE %s", $value[1]);
            } else {
                $condition[] = sprintf("%s %s", $value[0], $value[1]);
            }
        }

        return implode(' ', $condition);
    }

    private function buildFrom(?string $tableName): string
    {
        if ($tableName === null) {
            throw new \RuntimeException('Table name cannot be null');
        }

        return sprintf(' FROM %s ', $tableName);
    }

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