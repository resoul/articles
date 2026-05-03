<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Table
{
    public function __construct(public readonly string $table)
    {
    }
}
