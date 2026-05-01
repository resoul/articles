<?php
define('ROOT_PATH', dirname(__DIR__));

require_once __DIR__ . '/../vendor/autoload.php';

use Smarty\Smarty;

$smarty = new Smarty();
$smarty->setTemplateDir(sprintf('%s/%s/', ROOT_PATH, 'templates'));
$smarty->setCompileDir(sprintf('%s/%s/', ROOT_PATH, 'templates_c'));
$posts = [
    [
        "id" => 1,
        "title" => "Post title",
        "excerpt" => "Short description...",
        "image" => "/images/1.jpg"
    ],
    [
        "id" => 2,
        "title" => "Post title",
        "excerpt" => "Short description...",
        "image" => "/images/1.jpg"
    ]
];

$smarty->assign('posts', $posts);
echo $smarty->fetch(ROOT_PATH . "/templates/articles/listing.tpl");