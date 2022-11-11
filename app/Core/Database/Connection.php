<?php

namespace App\Core\Database;

use PDO;
use PDOException;

class Connection
{
    public PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public static function make($config)
    {
        try {
            return new static(new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            ));
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }
}
