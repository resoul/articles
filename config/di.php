<?php

declare(strict_types=1);

use App\DataAccess\Repository\ArticleRepository;
use App\DataAccess\Repository\CategoryRepository;
use App\DependencyInjection\Container;
use App\Domain\Repository\ArticleRepositoryInterface;
use App\Domain\Repository\CategoryRepositoryInterface;
use App\Infrastructure\Database\Connection;
use App\Infrastructure\Route\RouteCollection;
use App\Infrastructure\View\SmartyRenderer;
use App\Infrastructure\View\TemplateInterface;

return static function (Container $container): void {
    $container->boot(Connection::class, static fn (): Connection => new Connection(
        dsn: $_ENV['DB_DSN'],
        username: $_ENV['DB_USER'],
        password: $_ENV['DB_PASSWORD']
    ));

    $container->boot(RouteCollection::class, static fn (): RouteCollection => new RouteCollection());
    $container->boot(TemplateInterface::class, static fn (): TemplateInterface => new SmartyRenderer());

    $container->boot(
        CategoryRepositoryInterface::class,
        static fn (Container $c): CategoryRepositoryInterface => $c->make(CategoryRepository::class)
    );

    $container->boot(
        ArticleRepositoryInterface::class,
        static fn (Container $c): ArticleRepositoryInterface => $c->make(ArticleRepository::class)
    );
};
