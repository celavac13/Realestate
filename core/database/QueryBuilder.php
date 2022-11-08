<?php

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

    public function selectFavourites(int $user_id)
    {
        $handle = $this->pdo->prepare(
            "SELECT 
            * 
            FROM 
            favourites 
            LEFT JOIN realestates on favourites.realestate_id = realestates.id 
            WHERE favourites.user_id = :user_id"
        );
        $params = [
            ':user_id' => $user_id
        ];
        $handle->execute($params);

        return $handle->fetchAll(PDO::FETCH_OBJ);
    }

    public function allFavourites(int $userId)
    {
        $handle = $this->pdo->prepare(
            "SELECT realestate_id FROM favourites WHERE user_id = :user_id"
        );
        $params = [
            ':user_id' => $userId
        ];
        $handle->execute($params);

        return $handle->fetchAll(PDO::FETCH_OBJ);
    }
}
