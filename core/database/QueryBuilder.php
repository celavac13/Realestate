<?php

class QueryBuilder
{
    public $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        $handle = $this->pdo->prepare("SELECT * FROM $table");
        $handle->execute();

        return $handle->fetchAll(PDO::FETCH_OBJ);
    }

    public function sortByCity($cityId)
    {
        $handle = $this->pdo->prepare("SELECT * FROM realestates WHERE city_id = $cityId");
        $handle->execute();

        return $handle->fetchAll(PDO::FETCH_OBJ);
    }
}
