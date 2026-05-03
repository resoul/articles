<?php

declare(strict_types=1);

namespace App\Domain\Entity\Trait;

use App\Infrastructure\Database\Attribute\Column;
use DateTimeImmutable;

trait UpdatedAtTrait
{
    #[Column(name: 'updated_at')]
    protected DateTimeImmutable $updatedAt;

    public function setUpdatedAt(DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
