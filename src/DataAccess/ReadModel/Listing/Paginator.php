<?php

declare(strict_types=1);

namespace App\DataAccess\ReadModel\Listing;

use App\Domain\ValueObject\Listing\ListingPagination;
use App\Infrastructure\Database\Query;

class Paginator
{
    public function __construct(private Query $query, private ListingPagination $pagination,)
    {
    }

    public function getData(): array
    {
        $itemsQuery = clone $this->query;

        return $itemsQuery
            ->limit($this->pagination->perPage)
            ->offset($this->pagination->getOffset())
            ->getResult();
    }

    public function getCount(): int
    {
        $countQuery = clone $this->query;
        $countRow = $countQuery
            ->select('COUNT(1) AS total')
            ->resetOrderBy()
            ->resetLimit()
            ->resetOffset()
            ->getSingleResult();

        return max((int) ($countRow['total'] ?? 0), 0);
    }
}
