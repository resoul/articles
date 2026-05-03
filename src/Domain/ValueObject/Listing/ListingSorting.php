<?php

declare(strict_types=1);

namespace App\Domain\ValueObject\Listing;

class ListingSorting
{
    public function __construct(public ?string $orderBy, public ?string $orderDirection)
    {
    }
}
