<?php

declare(strict_types=1);

namespace App\Http\Controller\Home;

use App\Infrastructure\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __invoke()
    {
        $posts = [
            [
                "id" => 1,
                "title" => "Post title",
                "excerpt" => "Short description...",
                "image" => "/images/1.jpg"
            ],
            [
                "id" => 2,
                "title" => "Post title",
                "excerpt" => "Short description...",
                "image" => "/images/1.jpg"
            ]
        ];

        return $this->render("home/page.tpl", ["posts" => $posts]);
    }
}