<?php

use App\Cache\RedisCache;
use App\Models\Model;

require __DIR__ . '/vendor/autoload.php';
$config = require 'config.php';

$connection = App\Core\Database\Connection::make($config['database']);

Model::setDB($connection);
$client = new Predis\Client();
$redisCache = new RedisCache($client);
$cache = $redisCache;
