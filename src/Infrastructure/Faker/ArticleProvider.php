<?php

declare(strict_types=1);

namespace App\Infrastructure\Faker;

use Faker\Provider\Base;

class ArticleProvider extends Base
{
    private const NB_WORDS = 5;

    public function generateTitle(): string
    {
        $sentence = $this->generator->sentence(self::NB_WORDS);
        return substr($sentence, 0, strlen($sentence) - 1);
    }

    public function generateContent(): string
    {
        return $this->generator->paragraph(self::NB_WORDS);
    }
}
