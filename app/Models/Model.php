<?php

namespace App\Models;

use App\Core\Database\Connection;
use PDO;

abstract class Model
{
    protected static Connection $connection;
    protected static string $table;

    public static function setDB(Connection $connection)
    {
        static::$connection = $connection;
    }

    public static function find(int $id)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id = :id';
        $handle = static::$connection->pdo->prepare($sql);
        $params = [
            ':id' => $id
        ];
        $handle->execute($params);
        $data = $handle->fetchAll(PDO::FETCH_ASSOC)[0];
        return new static($data);
    }

    public static function all(): array
    {
        $sql = "SELECT * FROM " . static::$table;
        $handle = static::$connection->pdo->prepare($sql);
        $handle->execute();
        $data = $handle->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($data as $value) {
            $result[] = new static($value);
        }
        return $result;
    }
}
