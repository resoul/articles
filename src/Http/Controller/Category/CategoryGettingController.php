<?php

declare(strict_types=1);

namespace App\Http\Controller\Category;

use App\DataAccess\ReadModel\Article\ArticleListingQuery;
use App\Domain\Repository\CategoryRepositoryInterface;
use App\Http\Response\Page\Category\CategoryArticleListingPage;
use App\Infrastructure\Controller\AbstractController;

class CategoryGettingController extends AbstractController
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private ArticleListingQuery $articleListingQuery,
    ) {
    }

    public function __invoke(string $slug)
    {
        $category = $this->categoryRepository->findBySlug($slug);

        if ($category === null) {
            return $this->render('error/page.tpl');
        }

        $articles = $this->articleListingQuery->getListing(
            $this->getListingPagination(),
            $this->getListingSort(),
            $category->getId()
        );
        $page = new CategoryArticleListingPage(articles: $articles->items, categoryName: $category->getName());

        return $this->render('categories/article_listing.tpl', ['page' => $page]);
    }
}
