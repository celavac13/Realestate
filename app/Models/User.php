<?php

namespace App\Models;

use PDO;

class User extends Model
{
    protected int $id;
    protected string $username;
    protected string $name;
    protected string $email;
    protected string $password;
    protected static string $table = "users";

    public function __construct(array $data = [])
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }

        if (isset($data['username'])) {
            $this->username = $data['username'];
        }

        if (isset($data['name'])) {
            $this->name = $data['name'];
        }

        if (isset($data['email'])) {
            $this->email = $data['email'];
        }

        if (isset($data['password'])) {
            $this->password = $data['password'];
        }
    }


    // set methods
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


    // get methods
    public function getId()
    {
        return $this->id;
    }


    // query methods
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
            realestates.* 
            FROM 
            favourites 
            LEFT JOIN realestates on favourites.realestate_id = realestates.id 
            WHERE favourites.user_id = :user_id"
        );
        $params = [
            ':user_id' => $this->id
        ];
        $handle->execute($params);
        $data = $handle->fetchAll(PDO::FETCH_ASSOC);
        $realestates = [];
        foreach ($data as $realestate) {
            $realestates[] = new Realestate($realestate);
        }

        return $realestates;
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

        return (bool)$handle->fetchAll();
    }
}
