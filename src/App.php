<?php

declare(strict_types=1);

namespace App;

use App\DependencyInjection\Container;
use App\Http\Controller\Error\NotFountController;
use App\Infrastructure\Http\Response;
use App\Infrastructure\Route\RouteConfigurator;

class App
{
    public static function boot(Container $container, callable $services, callable $routes): void
    {
        $container->call($services);
        $container->call($routes);

        /**@var RouteConfigurator $configurator */
        $configurator = $container->make(RouteConfigurator::class);
        $routeController = $configurator->getRouteController();

        /**@var Response $response */
        $response = $container->make(Response::class);

        if ($routeController === null) {
            $response->setStatusCode(statusCode: 404);
            $routeController = [NotFountController::class, []];
        }

        [$controllerName, $parameters] = $routeController;

        $response->setContent(
            $container->make($controllerName)(...$parameters)
        )->send();
    }
}
