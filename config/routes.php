<?php

declare(strict_types=1);

use App\Http\Controller\Article\ArticleGettingController;
use App\Http\Controller\Article\ArticleListingController;
use App\Http\Controller\Category\CategoryGettingController;
use App\Http\Controller\Category\CategoryListingController;
use App\Http\Controller\Home\HomeController;
use App\Infrastructure\Route\RouteCollection;

return static function (RouteCollection $routes): void {
    $routes
        ->add('home', '/')
        ->method('GET')
        ->controller(HomeController::class);

    $routes
        ->add('article_listing', '/article/listing')
        ->method('GET')
        ->controller(ArticleListingController::class);

    $routes
        ->add('article_get', '/article/get/{slug}')
        ->method('GET')
        ->controller(ArticleGettingController::class);

    $routes
        ->add('category_listing', '/category/listing')
        ->method('GET')
        ->controller(CategoryListingController::class);

    $routes
        ->add('category_get', '/category/get/{slug}')
        ->method('GET')
        ->controller(CategoryGettingController::class);
};
