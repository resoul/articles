<?php

declare(strict_types=1);

namespace App\DataAccess\Repository;

use App\Domain\Entity\Category;
use App\Domain\Repository\CategoryRepositoryInterface;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Category::class);
    }

    /**
     * @return Category|null
     */
    public function findBySlug(string $slug): ?Category
    {
        $this->createQuery()
            ->where('slug = :slug')
            ->addParameter('slug', $slug);

        /** @var Category|null */
        return $this->getResult();
    }
}
