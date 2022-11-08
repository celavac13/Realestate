<?php

class FavouritesController
{
    public function show(QueryBuilder $query)
    {
        $realestates = $query->selectFavourites($_SESSION['user']['id']);

        require 'app/views/favourites.view.php';
    }

    public function addToFavourites(QueryBuilder $query)
    {
        $sql = 'INSERT INTO favourites (user_id, realestate_id) VALUES(:user_id, :realestate_id)';
        $handle = $query->pdo->prepare($sql);
        $params = [
            ':user_id' => $_GET['userId'],
            ':realestate_id' => $_GET['realestateId']
        ];
        $handle->execute($params);

        echo json_encode(['status' => true, 'message' => 'succesfully added to favourites']);
    }

    public function removeFromFavourites(QueryBuilder $query)
    {
        $sql = 'DELETE FROM favourites WHERE user_id = :user_id AND realestate_id = :realestate_id';
        $handle = $query->pdo->prepare($sql);
        $params = [
            ':user_id' => $_GET['userId'],
            ':realestate_id' => $_GET['realestateId']
        ];
        $handle->execute($params);

        echo json_encode(['status' => true, 'message' => 'succesfully removed from favourites']);
    }
}
