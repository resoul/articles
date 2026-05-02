<?php

declare(strict_types=1);

use App\Http\Controller\Home\HomeController;
use App\Infrastructure\Route\RouteCollection;

return static function (RouteCollection $routes): void {
    $routes
        ->add('home', '/')
        ->method('GET')
        ->controller(HomeController::class);
};