<?php

use App\Actions\LoginUser;
use App\Actions\RegisterUser;
use App\Models\City;
use App\Models\Model;
use App\Models\Realestate;
use App\Models\User;

require __DIR__ . '/vendor/autoload.php';
$config = require 'config.php';

$connection = App\Core\Database\Connection::make($config['database']);

Model::setDB($connection);
LoginUser::setDB($connection);
RegisterUser::setDB($connection);
