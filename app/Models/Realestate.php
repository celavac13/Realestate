<?php

namespace App\Models;

use Exception;
use PDO;

class Realestate
{
    protected static PDO $connection;
    protected int $id;
    protected User $user;
    protected int $cityId;
    protected string $title;
    protected string $description;
    protected int $price;
    protected string $imagePath;
    protected array $image;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'];
        $this->user = $data['user_id'];
        $this->cityId = $data['city_id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->price = $data['price'];
        $this->imagePath = $data['image'];
    }

    public static function setDB(PDO $connection)
    {
        static::$connection = $connection;
    }

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
        $data['user_id'] = User::find($data['user_id']);

        return new self($data);
    }

    public function setUser(User $user)
    {
        $this->user = $user;
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

    public function setImage(array $image)
    {
        $this->image = $image;
    }

    public function getId()
    {
        return $this->id;
    }

    public function save()
    {
        $targetFile =  "/public/images/" . $this->image['name'];
        $query = "INSERT INTO realestates (user_id, city_id, title, description, price, image) VALUES (:userId, :cityId, :title, :description, :price, :image)";

        if (move_uploaded_file($this->image['tmp_name'], SITE_ROOT . $targetFile)) {
            $handle = static::$connection->prepare($query);
            $params = [
                ':userId' => $this->user->id,
                ':cityId' => $this->cityId,
                ':title' => $this->title,
                ':description' => $this->description,
                ':price' => $this->price,
                ':image' => $targetFile
            ];
            $handle->execute($params);
        } else {

            throw new Exception('Image has not be uploaded');
        }
    }

    public static function selectAll()
    {
        $handle = static::$connection->prepare("SELECT * FROM realestates");
        $handle->execute();

        return $handle->fetchAll(PDO::FETCH_OBJ);
    }
}
