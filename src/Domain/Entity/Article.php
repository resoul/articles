<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Entity\Trait\CreatedAtTrait;
use App\Domain\Entity\Trait\IdentifierTrait;
use App\Domain\Entity\Trait\UpdatedAtTrait;
use App\Infrastructure\Database\Attribute\Column;
use App\Infrastructure\Database\Attribute\Table;

#[Table(table: 'articles')]
class Article
{
    use IdentifierTrait;
    use CreatedAtTrait;
    use UpdatedAtTrait;

    #[Column(name: 'title')]
    private string $title;

    #[Column(name: 'content')]
    private string $content;

    #[Column(name: 'image_url')]
    private string $imageUrl;

    #[Column(name: 'slug')]
    private string $slug;

    public function __construct(string $title, string $slug)
    {
        $this->title = $title;
        $this->slug = $slug;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
}
