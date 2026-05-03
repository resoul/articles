<?php

declare(strict_types=1);

namespace App\Infrastructure\View;

interface TemplateInterface
{
    /**
     * @param array<string, mixed> $data
     */
    public function render(string $template, array $data = []): string;
}
