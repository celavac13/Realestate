<?php

class AddNewRealestate
{
    protected QueryBuilder $query;
    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }

    public function addRealestate($userId, $cityId, $title, $description, $price, $image)
    {
        $errors = [];
        if (isset($_POST['submit'])) {
            $targetFile =  "/public/images/" . $image['name'];

            if (move_uploaded_file($image['tmp_name'], SITE_ROOT . $targetFile)) {
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
                } catch (PDOException $e) {
                    $errors[] = $e->getMessage();
                }
            } else {
                $errors[] = 'Image has not be uploaded';
            }
        }
    }
}
