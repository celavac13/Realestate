<?php

namespace App\Actions;

use PDO;

class Action
{
    protected static PDO $connection;

    public static function setDB(PDO $connection)
    {
        static::$connection = $connection;
    }
}
