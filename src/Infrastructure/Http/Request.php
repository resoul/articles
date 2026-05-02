<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

class Request
{
    public function getQueryParams(): array
    {
        return $_GET;
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
        return $_SERVER['REQUEST_URI'];
    }
}