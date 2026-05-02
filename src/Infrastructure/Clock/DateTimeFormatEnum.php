<?php

declare(strict_types=1);

namespace App\Infrastructure\Clock;

enum DateTimeFormatEnum : string
{
    case DB_DATE_TIME = 'Y-m-d H:i:s';
    case DB_DATE = 'Y-m-d';
}
