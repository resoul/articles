<?php

declare(strict_types=1);

use App\DependencyInjection\Container;
use App\Infrastructure\Database\Connection;
use App\Infrastructure\Route\RouteCollection;
use App\Infrastructure\View\TemplateInterface;
use App\Infrastructure\View\SmartyRenderer;

return static function (Container $container): void {
    $container->boot(Connection::class, static fn (): Connection => new Connection(
        dsn: $_ENV['DB_DSN'],
        username: $_ENV['DB_USER'],
        password: $_ENV['DB_PASSWORD']
    ));

    $container->boot(RouteCollection::class, static fn (): RouteCollection => new RouteCollection());
    $container->boot(TemplateInterface::class, static fn (): TemplateInterface => new SmartyRenderer());
};
