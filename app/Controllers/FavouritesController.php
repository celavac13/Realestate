<?php

namespace App\Controllers;

use App\Core\Database\QueryBuilder;
use App\Models\Realestate;
use App\Models\User;

class FavouritesController extends Controller
{
    public function show()
    {
        $user = $this->getLoggedInUser();

        if ($user === NULL) {
            header('location: /');
        }

        $realestates = $this->getLoggedInUser()->getFavouriteRealestates();

        require 'views/favourites.view.php';
    }

    public function addToFavourites()
    {
        $user = $this->getLoggedInUser();
        $realestate = Realestate::find($_GET['realestateId']);
        $user->addToFavourites($realestate);

        echo json_encode(['status' => true, 'message' => 'succesfully added to favourites']);
    }

    public function removeFromFavourites()
    {
        $user = $this->getLoggedInUser();
        $realestate = Realestate::find($_GET['realestateId']);
        $user->removeFromFavourites($realestate);

        echo json_encode(['status' => true, 'message' => 'succesfully removed from favourites']);
    }
}
