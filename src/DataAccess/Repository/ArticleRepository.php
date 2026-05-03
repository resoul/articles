<?php

declare(strict_types=1);

namespace App\DataAccess\Repository;

use App\Domain\Entity\Article;
use App\Domain\Repository\ArticleRepositoryInterface;

class ArticleRepository extends AbstractRepository implements ArticleRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Article::class);
    }

    /**
     * @return Article|null
     */
    public function findBySlug(string $slug): ?Article
    {
        $this->createQuery()
            ->where('slug = :slug')
            ->addParameter('slug', $slug);

        /** @var Article|null */
        return $this->getResult();
    }
}
