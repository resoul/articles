<?php

declare(strict_types=1);

namespace App\Infrastructure\Route;

use App\Infrastructure\Http\Request;

class RouteConfigurator
{
    public function __construct(private RouteCollection $routeCollection, private Request $request)
    {
    }

    /**
     * @return array<string, array>
     */
    public function getRouteController(): ?array
    {
        foreach ($this->routeCollection->getRoutes() as $route) {
            if ($route->getMethod() !== $this->request->getMethod()) {
                continue;
            }

            $pattern = $this->convertToPattern($route->getPattern());

            if (preg_match($pattern, $this->request->getUri(), $matches) !== 1) {
                continue;
            }

            $parameters = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            return [$route->getController(), $parameters];
        }

        return null;
    }

    private function convertToPattern(string $pattern): string
    {
        $regex = preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $pattern);
        return sprintf('#^%s$#', $regex);
    }
}
