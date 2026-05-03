<?php

declare(strict_types=1);

namespace App\Domain\ValueObject\Listing;

/** @template T */
class CollectionWithPagination
{
    /**
     * @param array<T> $items
     */
    public function __construct(public readonly array $items, public readonly ListingPagination $pagination)
    {
    }
}
