<?php

namespace App\Models;

use PDO;

class City
{
    protected static PDO $connection;

    public static function setDB(PDO $connection)
    {
        static::$connection = $connection;
    }

    public static function selectAll()
    {
        $handle = static::$connection->prepare("SELECT * FROM cities");
        $handle->execute();

        return $handle->fetchAll(PDO::FETCH_OBJ);
    }

    public static function sortByCity(string $cityName)
    {
        $handle = static::$connection->prepare(
            "SELECT 
            realestates.id, realestates.title, realestates.description, realestates.image 
            FROM 
            realestates 
            JOIN cities ON realestates.city_id = cities.id 
            WHERE cities.slug = :slug"
        );
        $params = [
            ':slug' => $cityName
        ];
        $handle->execute($params);

        return $handle->fetchAll(PDO::FETCH_OBJ);
    }
}
