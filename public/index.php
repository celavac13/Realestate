<?php

use App\Core\App;


error_reporting(E_ALL);
ini_set("display_errors", 1);

require '../bootstrap.php';

$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$app = new App($container, $router, $config);
$app->boot();
$app->run($request);
