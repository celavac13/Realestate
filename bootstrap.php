<?php

use App\Core\Config;
use App\Core\Request;
use App\Core\Router;
use DI\ContainerBuilder;

require '../vendor/autoload.php';
session_start();

$container = (new ContainerBuilder())->build();
$router = new Router(require '../app/routes.php');
$config = new Config(require('../config.php'));
$request = $_SERVER['REQUEST_URI'];
