<?php

namespace App\Models;

use Core\Database\QueryBuilder;

class User
{
    protected int $id;
    protected string $username;
    protected string $name;
    protected string $email;
    protected string $password;

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

    public function save(QueryBuilder $query)
    {
        $sql = "INSERT into users (username, name, email, password) VALUES (:username, :name, :email, :password)";

        $handle = $query->pdo->prepare($sql);
        $params = [
            ':username' => $this->username,
            ':name' => $this->name,
            ':email' => $this->email,
            ':password' => $this->password
        ];
        $handle->execute($params);
    }

    public function addToFavourites(Realestate $realestate)
    {
    }
}
