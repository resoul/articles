<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\DependencyInjection\Inject;
use App\Domain\ValueObject\Listing\ListingPagination;
use App\Domain\ValueObject\Listing\ListingSorting;
use App\Http\Request\Mapper\ListingParametersMapper;
use App\Infrastructure\Http\Request;
use App\Infrastructure\View\TemplateInterface;

abstract class AbstractController
{
    #[Inject]
    protected Request $request;

    #[Inject]
    protected TemplateInterface $template;

    protected function getListingPagination(): ListingPagination
    {
        return ListingParametersMapper::mapPaginationFromRequest($this->request->query);
    }

    public function getListingSort(): ListingSorting
    {
        return ListingParametersMapper::mapSortingFromRequest($this->request->query);
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function render(string $template, array $data = []): string
    {
        return $this->template->render($template, $data);
    }
}
