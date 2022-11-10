<?php

namespace App\Controllers;

use App\Models\City;
use App\Models\Realestate;
use App\Models\User;

class RealestateController extends Controller
{
    public function show()
    {
        // set data for page
        $realestate = Realestate::find($_GET['estate']);
        $cities = City::all();
        $totalInCity = fn ($slug) => City::findBySlug($slug)->getRealestates();

        // check if realestate is favourite
        if (NULL !== $this->getLoggedInUser()) {
            $isFavourite = (User::find($this->getLoggedInUser()))->isFavourite(Realestate::find($realestate->getId()));
        }

        require 'views/singleRealestate.view.php';
    }
}
