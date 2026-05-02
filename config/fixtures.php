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
    /**@var $db Connection */
    $db = $container->make(Connection::class);
    $db->open();

    $count = $db->createCommand("SELECT COUNT(*) FROM categories")->queryScalar();

    if ($count !== null && (int) $count > 0) {
        $db->close();
        exit("Database already seeded, skipping.\n");
    }

    $faker = Faker::create();
    $categoryIdx = $articleIdx = [];
    $articles = 15;

    for ($i = 0; $i < 5; $i++) {
        $categoryName = $faker->jobTitle();
        $db->createCommand("INSERT INTO categories (name, slug) VALUES (:name, :slug)", [
            ':name' => $categoryName,
            ':slug' => str_replace(' ', '-', strtolower($categoryName)),
        ])->execute();
        $categoryIdx[] = $db->getLastInsertId();
    }

    $sql = "INSERT INTO articles (title, image_url, content, slug) VALUES (:title, :imageUrl, :content, :slug)";
    for ($i = 0; $i < $articles; $i++) {
        $title = $faker->generateTitle();
        $db->createCommand($sql, [
            ':title' => $title,
            ':imageUrl' => "https://picperf.io/placeholder/360/220.jpeg",
            ':content' => $faker->generateContent(),
            ':slug' => str_replace(' ', '-', strtolower($title)),
        ])->execute();
        $articleIdx[] = $db->getLastInsertId();
    }

    $sql = "INSERT INTO article_category (article_id, category_id) VALUES (:articleId, :categoryId)";
    for ($i = 0; $i < $articles; $i++) {
        $shuffled = $categoryIdx;
        shuffle($shuffled);
        $assigned = array_slice($shuffled, 0, rand(1, count($shuffled)));

        foreach ($assigned as $categoryId) {
            $db->createCommand($sql, [
                ':articleId'   => $articleIdx[$i],
                ':categoryId'  => $categoryId,
            ])->execute();
        }
    }

    $db->close();
} catch (PDOException $e) {
    echo $e->getMessage();
}
