<?php

namespace App\Models;

use Exception;
use PDO;

class Realestate
{
    protected static PDO $connection;
    protected int $id;
    protected User $user;
    protected int $userId;
    protected int $cityId;
    protected string $title;
    protected string $description;
    protected int $price;
    protected string $image;

    public function __construct(array $data = [])
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }

        if (isset($data['user_id'])) {
            $this->userId = $data['user_id'];
        }

        if (isset($data['city_id'])) {
            $this->cityId = $data['city_id'];
        }

        if (isset($data['title'])) {
            $this->title = $data['title'];
        }

        if (isset($data['description'])) {
            $this->description = $data['description'];
        }

        if (isset($data['price'])) {
            $this->price = $data['price'];
        }

        if (isset($data['image'])) {
            $this->image = $data['image'];
        }
    }


    // set methods
    public static function setDB(PDO $connection)
    {
        static::$connection = $connection;
    }
    public function setUser(User $user)
    {
        $this->user = $user;
        $this->userId = $user->getId();
    }
    public function setCityId(int $cityId)
    {
        $this->cityId = $cityId;
    }
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
    public function setDescription(string $description)
    {
        $this->description = $description;
    }
    public function setPrice(int $price)
    {
        $this->price = $price;
    }
    public function setImage(string $image)
    {
        $this->image = $image;
    }


    // get methods
    public function getId(): int
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getImage(): string
    {
        return $this->image;
    }


    // query methods
    public static function find(int $id): self
    {
        $sql = "SELECT * FROM realestates WHERE id = :id";
        $handle = static::$connection->prepare($sql);
        $params = [
            ':id' => $id
        ];
        $handle->execute($params);
        $data = $handle->fetchAll(PDO::FETCH_ASSOC)[0];
        $data['id'] = (int) $data['id'];
        $data['user_id'] = User::find($data['user_id'])->getId();

        return new self($data);
    }

    public function save()
    {
        $sql = "INSERT INTO realestates (user_id, city_id, title, description, price, image) VALUES (:userId, :cityId, :title, :description, :price, :image)";
        $handle = static::$connection->prepare($sql);
        $params = [
            ':userId' => $this->user->getId(),
            ':cityId' => $this->cityId,
            ':title' => $this->title,
            ':description' => $this->description,
            ':price' => $this->price,
            ':image' => $this->image
        ];
        $handle->execute($params);
    }

    /**
     * @return Realestate[]
     */
    public static function all()
    {
        $sql = "SELECT * FROM realestates";
        $handle = static::$connection->prepare($sql);
        $handle->execute();
        $data = $handle->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $realestate) {
            $realestate['id'] = (int) $realestate['id'];
            $realestates[] = new self($realestate);
        }
        return $realestates;
    }
}
