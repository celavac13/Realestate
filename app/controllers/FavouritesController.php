<?php

class FavouritesController
{
    public function show(QueryBuilder $query)
    {
        $realestates = $query->selectFavourites($_SESSION['user']['id']);

        require 'app/views/favourites.view.php';
    }
}
