<?php

declare(strict_types=1);

namespace App\DataAccess\ReadModel\Category;

use App\DataAccess\ReadModel\AbstractReadModel;
use App\DataAccess\ReadModel\Category\DTO\CategoryDTO;
use App\DataAccess\ReadModel\Listing\CollectionWithPaginationFactory;
use App\Domain\ValueObject\Listing\CollectionWithPagination;
use App\Domain\ValueObject\Listing\ListingPagination;
use App\Domain\ValueObject\Listing\ListingSorting;
use App\Infrastructure\Clock\DateTimeFormatEnum;
use App\Infrastructure\Clock\DateTimeProvider;
use App\Infrastructure\Database\Query;

class CategoryListingQuery extends AbstractReadModel
{
    public function getListing(ListingPagination $pagination, ListingSorting $sort): CollectionWithPagination
    {
        $q = $this->createQuery();

        $q
            ->select('c.*')
            ->from('categories AS c');

        $q = $this->addListingSort($q, $sort);
        $paginator = $this->getPaginator($q, $pagination);

        $result = [];

        foreach ($paginator->getData() as $item) {
            $result[] = new CategoryDTO(
                id: (int) $item['id'],
                name: $item['name'],
                slug: $item['slug'],
                createdAt: DateTimeProvider::fromString($item['created_at'], DateTimeFormatEnum::DB_DATE_TIME)
            );
        }

        return CollectionWithPaginationFactory::build($pagination, $result, $paginator);
    }

    private function addListingSort(Query $query, ListingSorting $sort): Query
    {
        $map = [
            'id' => 'c.id',
            'name' => 'c.name',
        ];
        $orderField = $map[$sort->orderBy] ?? 'c.id';
        $query->orderBy($orderField, $sort->orderDirection);

        return $query;
    }
}
