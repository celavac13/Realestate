<?php

namespace App\Models;

use Exception;
use PDO;

class Realestate
{
    protected static PDO $connection;
    protected int $userId;
    protected int $cityId;
    protected string $title;
    protected string $description;
    protected int $price;
    protected array $image;

    public static function setDB(PDO $connection)
    {
        static::$connection = $connection;
    }

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
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

    public function save()
    {
        $targetFile =  "/public/images/" . $this->image['name'];
        $query = "INSERT INTO realestates (user_id, city_id, title, description, price, image) VALUES (:userId, :cityId, :title, :description, :price, :image)";

        if (move_uploaded_file($this->image['tmp_name'], SITE_ROOT . $targetFile)) {
            $handle = static::$connection->prepare($query);
            $params = [
                ':userId' => $this->userId,
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
}
