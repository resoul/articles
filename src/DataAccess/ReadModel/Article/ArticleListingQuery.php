<?php

declare(strict_types=1);

namespace App\DataAccess\ReadModel\Article;

use App\DataAccess\ReadModel\AbstractReadModel;
use App\DataAccess\ReadModel\Article\DTO\ArticleDTO;
use App\DataAccess\ReadModel\Listing\CollectionWithPaginationFactory;
use App\Domain\ValueObject\Listing\CollectionWithPagination;
use App\Domain\ValueObject\Listing\ListingPagination;
use App\Domain\ValueObject\Listing\ListingSorting;
use App\Infrastructure\Clock\DateTimeFormatEnum;
use App\Infrastructure\Clock\DateTimeProvider;
use App\Infrastructure\Database\Query;

class ArticleListingQuery extends AbstractReadModel
{
    public function getListing(
        ListingPagination $pagination,
        ListingSorting $sort,
        ?int $categoryId = null,
    ): CollectionWithPagination {
        $q = $this->createQuery();

        $q
            ->select('a.*')
            ->from('articles AS a');

        if ($categoryId !== null) {
            $q
                ->innerJoin('article_category AS ac', 'ac.article_id = a.id')
                ->where('ac.category_id = :categoryId')
                ->addParameter('categoryId', $categoryId);
        }

        $q = $this->addListingSort($q, $sort);
        $paginator = $this->getPaginator($q, $pagination);
        $result = [];

        foreach ($paginator->getData() as $item) {
            $result[] = new ArticleDTO(
                id: (int) $item['id'],
                title: $item['title'],
                slug: $item['slug'],
                imageUrl: $item['image_url'],
                content: $item['content'],
                createdAt: DateTimeProvider::fromString($item['created_at'], DateTimeFormatEnum::DB_DATE_TIME)
            );
        }

        return CollectionWithPaginationFactory::build($pagination, $result, $paginator);
    }

    private function addListingSort(Query $query, ListingSorting $sort): Query
    {
        $map = [
            'id' => 'a.id',
            'title' => 'a.title',
        ];
        $orderField = $map[$sort->orderBy] ?? 'a.id';
        $query->orderBy($orderField, $sort->orderDirection);

        return $query;
    }
}
