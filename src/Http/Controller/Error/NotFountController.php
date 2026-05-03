<?php

declare(strict_types=1);

namespace App\Http\Controller\Error;

use App\Infrastructure\Controller\AbstractController;

class NotFountController extends AbstractController
{
    public function __invoke()
    {
        return $this->render("error/page.tpl");
    }
}
