<?php

declare(strict_types=1);

namespace App\Http\Controller\Article;

use App\DataAccess\ReadModel\Article\ArticleListingQuery;
use App\Http\Response\Page\Article\ArticleListingPage;
use App\Infrastructure\Controller\AbstractController;

class ArticleListingController extends AbstractController
{
    public function __construct(private ArticleListingQuery $articleListingQuery)
    {
    }

    public function __invoke()
    {
        $sorting = $this->getListingSort();
        $articles = $this->articleListingQuery->getListing(
            pagination: $this->getListingPagination(),
            sort: $sorting
        );
        $page = new ArticleListingPage(
            articles: $articles->items,
            pagination: $articles->pagination,
            sorting: $sorting
        );

        return $this->render('articles/listing.tpl', ['page' => $page]);
    }
}
