<?php

namespace App\Controllers;

use App\Core\Database\QueryBuilder;
use App\Models\City;
use App\Models\Realestate;
use App\Models\User;

class RealestateController
{
    public function show()
    {
        $selectAll = Realestate::selectAll();
        $cities = City::selectAll();
        $totalInCity = fn ($slug) => City::sortByCity($slug);

        $realestate = $selectAll[array_search($_GET['estate'], array_column($selectAll, 'id'))];
        if (isset($_SESSION['user']['id'])) {
            $isFavourite = (User::find($_SESSION['user']['id']))->isFavourite(Realestate::find($realestate->id));
        }
        require 'views/singleRealestate.view.php';
    }
}
