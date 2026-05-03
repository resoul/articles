<?php

declare(strict_types=1);

namespace App\DataAccess\ReadModel\Category;

use App\DataAccess\ReadModel\AbstractReadModel;
use App\DataAccess\ReadModel\Category\DTO\CategoryDTO;
use App\Infrastructure\Clock\DateTimeFormatEnum;
use App\Infrastructure\Clock\DateTimeProvider;

class CategoryListingQuery extends AbstractReadModel
{
    public function getListing(): array
    {
        $q = $this->createQuery();

        $q
            ->select('*')
            ->from('categories');

        $result = [];

        foreach ($q->getResult() as $item) {
            $result[] = new CategoryDTO(
                id: (int) $item['id'],
                name: $item['name'],
                slug: $item['slug'],
                createdAt: DateTimeProvider::fromString($item['created_at'], DateTimeFormatEnum::DB_DATE_TIME)
            );
        }

        return $result;
    }
}
