<?php

declare(strict_types=1);

namespace App\Infrastructure\Faker;

use Faker\Factory;
use Faker\Generator;

class Faker
{
    public static function create(): Generator
    {
        $faker = Factory::create();
        $faker->addProvider(new ArticleProvider($faker));

        return $faker;
    }
}
