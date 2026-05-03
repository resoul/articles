<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\DTO;

class WhereConditionDTO
{
    public function __construct(public ?string $operator, public string $condition)
    {
    }
}
