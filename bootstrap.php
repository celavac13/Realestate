<?php

use App\Actions\Action;
use App\Models\Model;

require __DIR__ . '/vendor/autoload.php';
$config = require 'config.php';

$connection = App\Core\Database\Connection::make($config['database']);

Model::setDB($connection);
