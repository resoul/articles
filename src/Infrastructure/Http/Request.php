<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

class Request
{
    public QueryParameters $query;

    public function __construct()
    {
        $this->query = new QueryParameters($_GET);
    }

    public function getMethod(): string
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }

        return 'GET';
    }

    public function getUri(): string
    {
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($requestUri, PHP_URL_PATH);

        return is_string($path) && $path !== '' ? $path : '/';
    }
}
