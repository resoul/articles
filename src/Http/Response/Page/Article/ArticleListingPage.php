<?php

declare(strict_types=1);

namespace App\Http\Response\Page\Article;

use App\DataAccess\ReadModel\Article\DTO\ArticleDTO;
use App\Domain\ValueObject\Listing\ListingPagination;
use App\Domain\ValueObject\Listing\ListingSorting;

final class ArticleListingPage
{
    /**
     * @param array<ArticleDTO> $articles
     */
    public function __construct(
        public array $articles,
        public ListingPagination $pagination,
        public ListingSorting $sorting,
    ) {
    }
}
