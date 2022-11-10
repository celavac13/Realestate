<?php

namespace App\Models;

use PDO;

abstract class Model
{
    protected static PDO $connection;
    protected static string $table;

    public static function setDB(PDO $connection)
    {
        static::$connection = $connection;
    }

    public static function find(int $id)
    {
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id = :id';
        $handle = static::$connection->prepare($sql);
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
        $handle = static::$connection->prepare($sql);
        $handle->execute();
        $data = $handle->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($data as $value) {
            $result[] = new static($value);
        }
        return $result;
    }
}
