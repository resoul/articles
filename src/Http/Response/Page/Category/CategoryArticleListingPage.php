<?php

declare(strict_types=1);

namespace App\Http\Response\Page\Category;

use App\DataAccess\ReadModel\Article\DTO\ArticleDTO;

final class CategoryArticleListingPage
{
    /**
     * @param array<ArticleDTO> $articles
     */
    public function __construct(public array $articles, public string $categoryName)
    {
    }
}
