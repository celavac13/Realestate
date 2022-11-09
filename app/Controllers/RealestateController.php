<?php

namespace App\Controllers;

use App\Models\City;
use App\Models\Realestate;
use App\Models\User;

class RealestateController
{
    public function show()
    {
        // set data for page
        $realestate = Realestate::find($_GET['estate']);
        $cities = City::all();
        $totalInCity = fn ($slug) => City::findBySlug($slug)->getRealestates();

        // check if realestate is favourite
        if (isset($_SESSION['user']['id'])) {
            $isFavourite = (User::find($_SESSION['user']['id']))->isFavourite(Realestate::find($realestate->getId()));
        }

        // $user = $this->getLoggedInUser();
        // if (!$user) {
        // header('Location....')
        // }

        require 'views/singleRealestate.view.php';
    }

    // ovo u parent kontroler
    // public function getLoggedInUser(): ?User
    // {
    //     // ($_SESSION['user']['id'])
    // }
}
