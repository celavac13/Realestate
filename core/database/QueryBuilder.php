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
        // pripremamo sta cemo da izvrsimo u mysql
        $statement = $this->pdo->prepare("SELECT * FROM $table");

        // izvrsavamo gore sta je pripremljeno
        $statement->execute();

        // ovako prikazujemo sta se nalazi u ovom statementu
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function sortByCity($cityId)
    {
        $statement = $this->pdo->prepare("SELECT * FROM realestates WHERE city_id = $cityId");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
}
