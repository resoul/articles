<?php

declare(strict_types=1);

namespace App\Http\Controller\Home;

use App\DataAccess\ReadModel\Home\HomeListingQuery;
use App\Http\Response\Page\Home\HomePage;
use App\Infrastructure\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(private HomeListingQuery $homeListingQuery)
    {
    }

    public function __invoke()
    {
        $articles = $this->homeListingQuery->getListing();
        $page = new HomePage($articles);

        return $this->render('home/page.tpl', ['page' => $page]);
    }
}
