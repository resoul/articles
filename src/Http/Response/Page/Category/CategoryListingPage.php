<?php

declare(strict_types=1);

namespace App\Http\Response\Page\Category;

use App\DataAccess\ReadModel\Category\DTO\CategoryDTO;
use App\Domain\ValueObject\Listing\ListingPagination;

final class CategoryListingPage
{
    /**
     * @param array<CategoryDTO> $categories
     */
    public function __construct(public array $categories, public ListingPagination $pagination)
    {
    }
}
