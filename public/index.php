<?php
define('ROOT_PATH', dirname(__DIR__));

use App\App;
use App\DependencyInjection\Container;

require_once ROOT_PATH . '/vendor/autoload.php';

App::boot(
    container: new Container(),
    services: require_once ROOT_PATH . '/config/di.php',
    routes: require_once ROOT_PATH . '/config/routes.php'
);
