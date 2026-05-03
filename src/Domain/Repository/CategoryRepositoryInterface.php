<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Category;

interface CategoryRepositoryInterface
{
    public function findBySlug(string $slug): ?Category;
}
