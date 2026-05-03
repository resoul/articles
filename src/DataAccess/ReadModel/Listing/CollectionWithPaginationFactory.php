<?php

declare(strict_types=1);

namespace App\DataAccess\ReadModel\Listing;

use App\Domain\ValueObject\Listing\CollectionWithPagination;
use App\Domain\ValueObject\Listing\ListingPagination;

class CollectionWithPaginationFactory
{
    /**
     * @template T
     * @param array<T> $items
     * @return CollectionWithPagination<T>
     */
    public static function build(
        ListingPagination $pagination,
        array $items,
        Paginator $paginator,
    ): CollectionWithPagination {
        return new CollectionWithPagination(
            items: $items,
            pagination: new ListingPagination(
                page: $pagination->page,
                perPage: $pagination->perPage,
                totalItems: $paginator->getCount()
            )
        );
    }
}
