<?php

declare(strict_types=1);

namespace App\DataAccess\ReadModel\Article\DTO;

use DateTimeImmutable;

final class ArticleDTO
{
    public function __construct(
        public int $id,
        public string $title,
        public string $slug,
        public string $imageUrl,
        public string $content,
        public DateTimeImmutable $createdAt,
    ) {
    }
}
