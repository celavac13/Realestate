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

    public function __construct(array $data = [])
    {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }

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

    public static function find(int $id): self
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $handle = static::$connection->prepare($sql);
        $params = [
            ':id' => $id
        ];
        $handle->execute($params);
        $data = $handle->fetchAll(PDO::FETCH_ASSOC)[0];
        $data['id'] = (int) $data['id'];
        return new self($data);
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

    public function addToFavourites(Realestate $realestate): bool
    {
        $sql = 'INSERT INTO favourites (user_id, realestate_id) VALUES(:user_id, :realestate_id)';
        $handle = static::$connection->prepare($sql);
        $params = [
            ':user_id' => $this->id,
            ':realestate_id' => $realestate->getId()
        ];
        return $handle->execute($params);
    }

    public function removeFromFavourites(Realestate $realestate): bool
    {
        $sql = 'DELETE FROM favourites WHERE user_id = :user_id AND realestate_id = :realestate_id';
        $handle = static::$connection->prepare($sql);
        $params = [
            ':user_id' => $this->id,
            ':realestate_id' => $realestate->getId()
        ];
        return $handle->execute($params);
    }

    /**
     *
     * @return Realestate[]
     */
    public function getFavouriteRealestates(): array
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
            ':user_id' => $this->id
        ];
        $handle->execute($params);

        return $handle->fetchAll(PDO::FETCH_OBJ);
    }

    public function isFavourite(Realestate $realestate): bool
    {
        $sql = "SELECT realestate_id FROM favourites WHERE user_id = :user_id and realestate_id = :realestate_id";
        $handle = static::$connection->prepare($sql);
        $params = [
            ':user_id' => $this->id,
            ':realestate_id' => $realestate->getId()
        ];
        $handle->execute($params);
        $data = $handle->fetchAll();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
}
