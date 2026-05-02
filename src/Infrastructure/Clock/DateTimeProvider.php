<?php

declare(strict_types=1);

namespace App\Infrastructure\Clock;

use DateTimeImmutable;

class DateTimeProvider
{
    public static function fromString(string $date, DateTimeFormatEnum $format): DateTimeImmutable
    {
        $result = DateTimeImmutable::createFromFormat($format->value, $date);
        assert($result instanceof DateTimeImmutable);
        return $result;
    }
}
