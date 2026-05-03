<?php

declare(strict_types=1);

namespace App\Infrastructure\Route;

class Route
{
    private string $method = 'GET';
    private string $controller;

    public function __construct(private string $name, private string $pattern)
    {
    }

    public function method(string $method): self
    {
        $this->method = strtoupper($method);
        return $this;
    }

    public function controller(string $controller): self
    {
        $this->controller = $controller;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getController(): string
    {
        return $this->controller;
    }
}
