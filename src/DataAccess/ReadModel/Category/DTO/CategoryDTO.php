<?php

declare(strict_types=1);

namespace App\DataAccess\ReadModel\Category\DTO;

use DateTimeImmutable;

final class CategoryDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public string $slug,
        public DateTimeImmutable $createdAt,
    ) {
    }
}
