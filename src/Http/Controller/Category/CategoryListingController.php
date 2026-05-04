<?php

declare(strict_types=1);

namespace App\Http\Controller\Category;

use App\DataAccess\ReadModel\Category\CategoryListingQuery;
use App\Http\Response\Page\Category\CategoryListingPage;
use App\Infrastructure\Controller\AbstractController;

class CategoryListingController extends AbstractController
{
    public function __construct(private CategoryListingQuery $categoryListingQuery)
    {
    }

    public function __invoke()
    {
        $categories = $this->categoryListingQuery->getListing(
            pagination: $this->getListingPagination(),
            sort: $this->getListingSort()
        );

        $page = new CategoryListingPage(
            categories: $categories->items,
            pagination: $categories->pagination
        );

        return $this->render('categories/listing.tpl', ['page' => $page]);
    }
}
