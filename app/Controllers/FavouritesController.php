<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Models\Realestate;

class FavouritesController extends Controller
{
    public function show(Response $response): Response
    {
        $user = $this->getLoggedInUser();

        if ($user === NULL) {
            return $response->redirect('/');
        }

        $realestates = $this->getLoggedInUser()->getFavouriteRealestates();

        return $response->data(['realestates' => $realestates, 'loggedInUser' => $this->getLoggedInUser()])->view('favourites');
    }

    public function addToFavourites(Request $request, Response $response): Response
    {
        $user = $this->getLoggedInUser();
        $realestate = Realestate::find($request->get('realestateId'));
        $user->addToFavourites($realestate);

        return $response->data(['status' => true, 'message' => 'succesfully added to favourites'])->json();
    }

    public function removeFromFavourites(Request $request, Response $response): Response
    {
        $user = $this->getLoggedInUser();
        $realestate = Realestate::find($request->get('realestateId'));
        $user->removeFromFavourites($realestate);

        return $response->data(['status' => true, 'message' => 'succesfully removed from favourites'])->json();
    }
}
