<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use App\Infrastructure\Database\Attribute\Column;
use DateTimeImmutable;
use ReflectionClass;

class EntityManager
{
    /**
     * @param array<string, mixed> $row
     */
    public function map(string $entityClass, array $row): object
    {
        $reflection = new ReflectionClass($entityClass);
        $constructor = $reflection->getConstructor();

        if ($constructor !== null) {
            $args = $this->resolveConstructorArgs($reflection, $constructor, $row);
            $entity = $reflection->newInstanceArgs($args);
        } else {
            $entity = $reflection->newInstanceWithoutConstructor();
        }

        foreach ($this->getAllProperties($reflection) as $property) {
            if ($property->isInitialized($entity) && $property->getValue($entity) !== null) {
                continue;
            }

            $attributes = $property->getAttributes(Column::class);

            if (empty($attributes)) {
                continue;
            }

            $column = $attributes[0]->newInstance();

            if (!array_key_exists($column->name, $row)) {
                continue;
            }

            $property->setValue($entity, $this->setValue($property->getType(), $row[$column->name]));
        }

        return $entity;
    }

    /**
     * @param array<string, mixed> $row
     * @return array<int, mixed>
     */
    private function resolveConstructorArgs(
        ReflectionClass $reflection,
        \ReflectionMethod $constructor,
        array $row,
    ): array {
        $args = [];
        $propertyColumnMap = $this->buildPropertyColumnMap($reflection);

        foreach ($constructor->getParameters() as $param) {
            $paramName = $param->getName();
            $columnName = $propertyColumnMap[$paramName] ?? null;

            if ($columnName !== null && array_key_exists($columnName, $row)) {
                $args[] = $this->setValue($param->getType(), $row[$columnName]);
            } elseif ($param->isDefaultValueAvailable()) {
                $args[] = $param->getDefaultValue();
            } elseif ($param->allowsNull()) {
                $args[] = null;
            } else {
                throw new \RuntimeException(
                    "Cannot resolve constructor param \${$paramName} for {$reflection->getName()}"
                );
            }
        }

        return $args;
    }

    private function buildPropertyColumnMap(ReflectionClass $reflection): array
    {
        $map = [];

        foreach ($this->getAllProperties($reflection) as $property) {
            $attributes = $property->getAttributes(Column::class);

            if (empty($attributes)) {
                continue;
            }

            $column = $attributes[0]->newInstance();
            $map[$property->getName()] = $column->name;
        }

        return $map;
    }

    private function getAllProperties(ReflectionClass $reflection): array
    {
        $properties = $seen = [];

        $class = $reflection;

        while ($class !== false) {
            foreach ($class->getProperties() as $property) {
                if (isset($seen[$property->getName()])) {
                    continue;
                }

                $seen[$property->getName()] = true;
                $properties[] = $property;
            }

            $class = $class->getParentClass();
        }

        return $properties;
    }

    private function setValue(mixed $type, mixed $value): mixed
    {
        if (!$type instanceof \ReflectionNamedType || $value === null) {
            return $value;
        }

        return match ($type->getName()) {
            'int' => (int) $value,
            'float' => (float) $value,
            'bool' => (bool) $value,
            'string' => (string) $value,
            DateTimeImmutable::class => new DateTimeImmutable($value),
            default => $value,
        };
    }
}
