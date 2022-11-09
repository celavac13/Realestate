<?php

namespace App\Controllers;

use App\Core\Database\QueryBuilder;
use App\Models\User;

class FavouritesController
{
    public function show()
    {
        $realestates = User::getFavouriteRealestates();

        require 'views/favourites.view.php';
    }

    public function handleFavourites()
    {
        return new User();
    }
}
