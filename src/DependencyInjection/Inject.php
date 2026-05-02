<?php

declare(strict_types=1);

namespace App\DependencyInjection;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Inject
{
}
