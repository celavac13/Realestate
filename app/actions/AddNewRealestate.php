<?php

class AddNewRealestate
{
    protected QueryBuilder $query;
    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }

    public function validate(int $userId, int $cityId, string $title, string $description, int $price, array $image)
    {
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
            $targetFile =  "/public/images/" . $image['name'];

            if (move_uploaded_file($image['tmp_name'], SITE_ROOT . $targetFile)) {
                $result['params'] = [
                    'userId' => $userId,
                    'cityId' => $cityId,
                    'title' => $title,
                    'description' => $description,
                    'price' => $price,
                    'image' => $image,
                    'targetFile' => $targetFile
                ];

                return $result;
            } else {
                $result['errors'] = 'Image has not be uploaded';

                return $result;
            }
        } else {
            $result['errors'] = 'Fields must be fullfiled';

            return $result;
        }
    }

    public function addRealestate($params)
    {
        extract($params);
        $query = "INSERT INTO realestates (user_id, city_id, title, description, price, image) VALUES (:userId, :cityId, :title, :description, :price, :image)";
        try {
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
            header('location: http://www.realestate.local');
            exit();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
