<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\DependencyInjection\Inject;
use App\Infrastructure\View\TemplateInterface;

abstract class AbstractController
{
    #[Inject]
    protected TemplateInterface $template;

    protected function render(string $template, array $data = []): string
    {
        return $this->template->render($template, $data);
    }
}
