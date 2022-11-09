<?php

namespace App\Models;

use PDO;

class User
{
    protected static PDO $connection;
    protected int $id;
    protected string $username;
    protected string $name;
    protected string $email;
    protected string $password;

    public static function setDB(PDO $connection)
    {
        static::$connection = $connection;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setUsername(string $username)
    {
        $this->username = $username;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function save()
    {
        $sql = "INSERT into users (username, name, email, password) VALUES (:username, :name, :email, :password)";

        $handle = static::$connection->prepare($sql);
        $params = [
            ':username' => $this->username,
            ':name' => $this->name,
            ':email' => $this->email,
            ':password' => $this->password
        ];
        $handle->execute($params);
    }

    public function addToFavourites()
    {
        $sql = 'INSERT INTO favourites (user_id, realestate_id) VALUES(:user_id, :realestate_id)';
        $handle = static::$connection->prepare($sql);
        $params = [
            ':user_id' => $_SESSION['user']['id'],
            ':realestate_id' => $_GET['realestateId']
        ];
        $handle->execute($params);

        echo json_encode(['status' => true, 'message' => 'succesfully added to favourites']);
    }

    public function removeFromFavourites()
    {
        $sql = 'DELETE FROM favourites WHERE user_id = :user_id AND realestate_id = :realestate_id';
        $handle = static::$connection->prepare($sql);
        $params = [
            ':user_id' => $_GET['userId'],
            ':realestate_id' => $_GET['realestateId']
        ];
        $handle->execute($params);

        echo json_encode(['status' => true, 'message' => 'succesfully removed from favourites']);
    }

    /**
     *
     * @return Realestate[]
     */
    public static function getFavouriteRealestates(): array
    {
        $handle = static::$connection->prepare(
            "SELECT 
            * 
            FROM 
            favourites 
            LEFT JOIN realestates on favourites.realestate_id = realestates.id 
            WHERE favourites.user_id = :user_id"
        );
        $params = [
            ':user_id' => $_SESSION['user']['id']
        ];
        $handle->execute($params);

        return $handle->fetchAll(PDO::FETCH_OBJ);
    }

    //ako budes umeo dadaj kao i gore ovaj @return Realestate, tj napravi model za realestate tako da bude kao da je iz baze podataka
    public static function getAllFavouriteRealestate(): array
    {
        $handle = static::$connection->prepare(
            "SELECT realestate_id FROM favourites WHERE user_id = :user_id"
        );
        $params = [
            ':user_id' => $_SESSION['user']['id']
        ];
        $handle->execute($params);

        return $handle->fetchAll(PDO::FETCH_OBJ);
    }
}
