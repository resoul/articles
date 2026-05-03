<?php

declare(strict_types=1);

namespace App\Infrastructure\Route;

class RouteCollection
{
    /**
     * @var array<Route> $routes
     */
    private array $routes = [];

    public function add(string $name, string $pattern): Route
    {
        $route = new Route($name, $pattern);
        $this->routes[$name] = $route;

        return $route;
    }

    /**
     * @return array<Route>
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}
