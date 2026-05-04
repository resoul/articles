<?php

declare(strict_types=1);

namespace App\Http\Request\Mapper;

use App\Domain\ValueObject\Listing\ListingPagination;
use App\Domain\ValueObject\Listing\ListingSorting;
use App\Infrastructure\Http\QueryParameters;

class ListingParametersMapper
{
    private const DEFAULT_PER_PAGE = 10;
    private const MAX_PAGE_SIZE = 100;
    private const ALLOWED_SORTING_DIRECTIONS = ['ASC', 'DESC'];
    private const DEFAULT_SORTING_DIRECTION = 'DESC';

    public static function mapPaginationFromRequest(QueryParameters $query): ListingPagination
    {
        $perPage = (int) ($query->get('perPage', self::DEFAULT_PER_PAGE));
        $page = max((int) $query->get('page', 1), 1);

        return new ListingPagination($page, min($perPage, self::MAX_PAGE_SIZE));
    }

    public static function mapSortingFromRequest(QueryParameters $query): ListingSorting
    {
        $direction = $query->get('orderDirection');

        if ($direction !== null) {
            $direction = strtoupper($direction);

            if (!in_array($direction, self::ALLOWED_SORTING_DIRECTIONS, true)) {
                $direction = self::DEFAULT_SORTING_DIRECTION;
            }
        }

        $orderBy = $query->get('orderBy');

        return new ListingSorting($orderBy, $direction);
    }
}
