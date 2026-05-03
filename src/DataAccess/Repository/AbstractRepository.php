<?php

declare(strict_types=1);

namespace App\DataAccess\Repository;

use App\DependencyInjection\Inject;
use App\Infrastructure\Database\Attribute\Table;
use App\Infrastructure\Database\EntityManager;
use App\Infrastructure\Database\Query;
use ReflectionClass;

abstract class AbstractRepository
{
    #[Inject]
    protected EntityManager $entityManager;
    #[Inject]
    protected Query $query;

    public function __construct(private readonly string $entityClass)
    {
    }

    protected function createQuery(): Query
    {
        return $this->query->select('*')->from($this->getTableName());
    }

    /**
     * @template T of object
     * @return T|null
     */
    protected function getResult(): ?object
    {
        $result = $this->query->getSingleResult();

        if ($result === null) {
            return null;
        }

        return $this->entityManager->map($this->entityClass, $result);
    }

    private function getTableName(): string
    {
        $reflection = new ReflectionClass($this->entityClass);
        $attributes = $reflection->getAttributes(Table::class);

        if (empty($attributes)) {
            throw new \RuntimeException("Entity {$this->entityClass} must have #[Table] attribute");
        }

        $table = $attributes[0]->newInstance();
        return $table->table;
    }
}
