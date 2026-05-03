<?php

declare(strict_types=1);

namespace App\Http\Response\Page\Home;

use App\DataAccess\ReadModel\Article\DTO\ArticleDTO;

final class HomePage
{
    /**
     * @param array<ArticleDTO> $articles
     */
    public function __construct(public array $articles)
    {
    }
}
