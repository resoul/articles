<?php

declare(strict_types=1);

namespace App\Domain\Entity\Trait;

use App\Infrastructure\Database\Attribute\Column;

trait IdentifierTrait
{
    #[Column(name: 'id')]
    private ?int $id = null;

    public function getId(): int
    {
        if ($this->id === null) {
            throw new \RuntimeException('ID is not defined because entity not saved');
        }

        return $this->id;
    }
}
