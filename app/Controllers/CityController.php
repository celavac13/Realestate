<?php

namespace App\Controllers;

use App\Core\Database\QueryBuilder;

class CityController
{
    public function show(QueryBuilder $query, $cities, $totalInCity)
    {
        $realestates = $query->sortByCity($_GET['city']);
        require 'views/index.view.php';
    }
}
