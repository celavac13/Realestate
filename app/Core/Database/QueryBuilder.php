<?php

namespace App\Core\Database;

use PDO;

class QueryBuilder
{
    public $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll(string $table)
    {
        $handle = $this->pdo->prepare("SELECT * FROM $table");
        $handle->execute();

        return $handle->fetchAll(PDO::FETCH_OBJ);
    }

    public function sortByCity($slug)
    {

        $handle = $this->pdo->prepare(
            "SELECT 
            realestates.id, realestates.title, realestates.description, realestates.image 
            FROM 
            realestates 
            JOIN cities ON realestates.city_id = cities.id 
            WHERE cities.slug = :slug"
        );
        $params = [
            ':slug' => $slug
        ];
        $handle->execute($params);

        return $handle->fetchAll(PDO::FETCH_OBJ);
    }
}
