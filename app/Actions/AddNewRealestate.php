<?php

namespace App\Actions;

use App\Core\Database\QueryBuilder;
use FFI\Exception;

class AddNewRealestate
{
    protected QueryBuilder $query;
    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }

    public function validate($params)
    {
        extract($params);
        $result = [];
        if (
            isset($userId, $cityId, $title, $description, $price, $image)
            && !empty($userId)
            && !empty($cityId)
            && !empty($title)
            && !empty($description)
            && !empty($price)
            && !empty($image)
        ) {
            $result = [
                'validate' => true
            ];

            return $result;
        } else {
            $result['errors'] = 'Fields must be fullfiled';
            return $result;
        }
    }

    public function addRealestate(int $userId, int $cityId, string $title, string $description, int $price, array $image)
    {
        $targetFile =  "/public/images/" . $image['name'];
        $query = "INSERT INTO realestates (user_id, city_id, title, description, price, image) VALUES (:userId, :cityId, :title, :description, :price, :image)";

        if (move_uploaded_file($image['tmp_name'], SITE_ROOT . $targetFile)) {
            $handle = $this->query->pdo->prepare($query);
            $params = [
                ':userId' => $userId,
                ':cityId' => $cityId,
                ':title' => $title,
                ':description' => $description,
                ':price' => $price,
                ':image' => $targetFile
            ];
            $handle->execute($params);
        } else {

            throw new Exception('Image has not be uploaded');
        }
    }
}
