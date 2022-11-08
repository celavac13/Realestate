<?php

namespace App\Controllers;

use Core\Database\QueryBuilder;

class RealestateController
{
    public function show(QueryBuilder $query, $cities, $totalInCity)
    {
        $selectAll = $query->selectAll('realestates');
        $allFavourites = $query->allFavourites($_SESSION['user']['id']);
        $realestate = $selectAll[array_search($_GET['estate'], array_column($selectAll, 'id'))];
        $isFavourite = false;
        if (array_search($realestate->id, array_column($allFavourites, 'realestate_id')) !== false) {
            $isFavourite = true;
        }
        require 'app/views/singleRealestate.view.php';
    }
}
