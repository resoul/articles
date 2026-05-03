<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Entity\Trait\CreatedAtTrait;
use App\Domain\Entity\Trait\IdentifierTrait;
use App\Infrastructure\Database\Attribute\Column;
use App\Infrastructure\Database\Attribute\Table;

#[Table(table: 'categories')]
class Category
{
    use IdentifierTrait;
    use CreatedAtTrait;

    #[Column(name: 'name')]
    private string $name;

    #[Column(name: 'slug')]
    private string $slug;

    public function __construct(string $name, string $slug)
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
