<?php

use App\Core\App;

error_reporting(E_ALL);
ini_set("display_errors", 1);

require '../bootstrap.php';

$app = new App($container, $router, $config);
$app->boot();
$app->run();
