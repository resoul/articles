<?php

declare(strict_types=1);

namespace App\Infrastructure\View;

use Smarty\Smarty;

class SmartyRenderer implements TemplateInterface
{
    private Smarty $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(sprintf('%s/%s/', ROOT_PATH, 'templates'));
        $this->smarty->setCompileDir(sprintf('%s/%s/', ROOT_PATH, 'templates_c'));
    }

    /**
     * @param array<string, mixed> $data
     */
    public function render(string $template, array $data = []): string
    {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        return $this->smarty->fetch($template);
    }
}
