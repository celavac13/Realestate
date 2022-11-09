<?php

use App\Models\Realestate;
use App\Models\User;

require __DIR__ . '/vendor/autoload.php';
$config = require 'config.php';

$connection = App\Core\Database\Connection::make($config['database']);

User::setDB($connection);
Realestate::setDB($connection);
