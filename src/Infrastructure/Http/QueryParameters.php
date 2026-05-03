<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

final class QueryParameters
{
    /**
     * @param array<string, mixed> $params
     */
    public function __construct(private array $params)
    {
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->params[$key] ?? $default;
    }
}
