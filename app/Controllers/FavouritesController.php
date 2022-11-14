<?php

namespace App\Controllers;

use App\Core\Request;
use App\Models\Realestate;

class FavouritesController extends Controller
{
    public function show()
    {
        $user = $this->getLoggedInUser();

        if ($user === NULL) {
            return $this->redirect('/');
        }

        $realestates = $this->getLoggedInUser()->getFavouriteRealestates();

        require '../views/favourites.view.php';
    }

    public function addToFavourites(Request $request)
    {
        $user = $this->getLoggedInUser();
        $realestate = Realestate::find($request->get('realestateId'));
        $user->addToFavourites($realestate);

        echo json_encode(['status' => true, 'message' => 'succesfully added to favourites']);
    }

    public function removeFromFavourites(Request $request)
    {
        $user = $this->getLoggedInUser();
        $realestate = Realestate::find($request->get('realestateId'));
        $user->removeFromFavourites($realestate);

        echo json_encode(['status' => true, 'message' => 'succesfully removed from favourites']);
    }
}
