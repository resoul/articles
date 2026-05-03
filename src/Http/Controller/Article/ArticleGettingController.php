<?php

declare(strict_types=1);

namespace App\Http\Controller\Article;

use App\Domain\Repository\ArticleRepositoryInterface;
use App\Http\Response\Page\Article\ArticleGettingPage;
use App\Infrastructure\Controller\AbstractController;

class ArticleGettingController extends AbstractController
{
    public function __construct(private ArticleRepositoryInterface $articleRepository)
    {
    }

    public function __invoke(string $slug)
    {
        $article = $this->articleRepository->findBySlug($slug);

        if ($article === null) {
            return $this->render('error/page.tpl');
        }

        $page = new ArticleGettingPage(
            title: $article->getTitle(),
            slug: $article->getSlug(),
            imageUrl: $article->getImageUrl(),
            content: $article->getContent(),
            createdAt: $article->getCreatedAt()
        );

        return $this->render('articles/get.tpl', ['page' => $page]);
    }
}
