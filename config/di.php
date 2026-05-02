<?php

declare(strict_types=1);

use App\DependencyInjection\Container;
use App\Infrastructure\Database\Connection;

return static function (Container $container) {
    $container->boot(Connection::class, static fn (): Connection => new Connection(
        dsn: $_ENV['DB_DSN'],
        username: $_ENV['DB_USER'],
        password: $_ENV['DB_PASSWORD']
    ));
};
