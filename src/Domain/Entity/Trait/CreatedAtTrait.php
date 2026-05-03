<?php

declare(strict_types=1);

namespace App\Domain\Entity\Trait;

use App\Infrastructure\Database\Attribute\Column;
use DateTimeImmutable;

trait CreatedAtTrait
{
    #[Column(name: 'created_at')]
    protected DateTimeImmutable $createdAt;

    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
