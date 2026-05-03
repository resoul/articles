<?php

declare(strict_types=1);

namespace App\DataAccess\ReadModel;

use App\DataAccess\ReadModel\Listing\Paginator;
use App\Domain\ValueObject\Listing\ListingPagination;
use App\Infrastructure\Database\Query;

abstract class AbstractReadModel
{
    public function __construct(private Query $query)
    {
    }

    protected function createQuery(): Query
    {
        return $this->query;
    }

    protected function getPaginator(Query $query, ListingPagination $pagination): Paginator
    {
        return new Paginator($query, $pagination);
    }
}
