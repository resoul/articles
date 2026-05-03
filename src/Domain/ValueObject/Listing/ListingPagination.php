<?php

declare(strict_types=1);

namespace App\Domain\ValueObject\Listing;

class ListingPagination
{
    public function __construct(public int $page = 1, public int $perPage = 10, public int $totalItems = 0)
    {
    }

    public function getOffset(): int
    {
        return ($this->page - 1) * $this->perPage;
    }

    public function getTotalPages(): int
    {
        if ($this->perPage <= 0) {
            return 1;
        }

        return max((int) ceil($this->totalItems / $this->perPage), 1);
    }
}
