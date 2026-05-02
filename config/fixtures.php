<?php

declare(strict_types=1);

define('ROOT_PATH', dirname(__DIR__));

use App\DependencyInjection\Container;
use App\Infrastructure\Database\Connection;
use App\Infrastructure\Faker\Faker;

require_once ROOT_PATH . '/vendor/autoload.php';
$di = require_once ROOT_PATH . '/config/di.php';

$container = new Container();
$di($container);

try {
    $faker = Faker::create();
    $rows = 15;
    /**@var $db Connection */
    $db = $container->make(Connection::class);
    $db->open();

    for ($i = 0; $i < $rows; $i++) {
        $title = $faker->generateTitle();
        $db->createCommand("INSERT INTO articles (title, content, slug) VALUES (:title, :content, :slug)", [
            ':title' => $title,
            ':content' => $faker->generateContent(),
            ':slug' => str_replace(' ', '-', strtolower($title)),
        ])->execute();
    }

    $db->close();
} catch (PDOException $e) {
    echo $e->getMessage();
}
