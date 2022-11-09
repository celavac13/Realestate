<?php

namespace App\Controllers;

use App\Core\Database\QueryBuilder;
use App\Models\User;

class RealestateController
{
    public function show(QueryBuilder $query, $cities, $totalInCity)
    {
        $selectAll = $query->selectAll('realestates');
        $realestate = $selectAll[array_search($_GET['estate'], array_column($selectAll, 'id'))];
        if (isset($_SESSION['user']['id'])) {
            $allFavourites = User::getAllFavouriteRealestate();
            $isFavourite = false;
            if (array_search($realestate->id, array_column($allFavourites, 'realestate_id')) !== false) {
                $isFavourite = true;
            }
        }
        require 'views/singleRealestate.view.php';
    }
}
