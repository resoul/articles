<?php

declare(strict_types=1);

namespace App\Http\Response\Page\Article;

use DateTimeImmutable;

final class ArticleGettingPage
{
    public function __construct(
        public string $title,
        public string $slug,
        public string $imageUrl,
        public string $content,
        public DateTimeImmutable $createdAt,
    ) {
    }
}
