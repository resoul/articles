<?php

declare(strict_types=1);

namespace App\DataAccess\ReadModel\Home;

use App\DataAccess\ReadModel\AbstractReadModel;
use App\DataAccess\ReadModel\Article\DTO\ArticleDTO;
use App\Infrastructure\Clock\DateTimeFormatEnum;
use App\Infrastructure\Clock\DateTimeProvider;

class HomeListingQuery extends AbstractReadModel
{
    /**
     * @return array<ArticleDTO>
     */
    public function getListing(): array
    {
        $q = $this->createQuery();

        $q
            ->select('a.*')
            ->from('articles AS a')
            ->limit(3);

        $result = [];

        foreach ($q->getResult() as $item) {
            $result[] = new ArticleDTO(
                id: (int) $item['id'],
                title: $item['title'],
                slug: $item['slug'],
                imageUrl: $item['image_url'],
                content: $item['content'],
                createdAt: DateTimeProvider::fromString($item['created_at'], DateTimeFormatEnum::DB_DATE_TIME)
            );
        }

        return $result;
    }
}
