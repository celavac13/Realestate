<?php

namespace App\Controllers;

use App\Core\Database\QueryBuilder;
use App\Models\City;

class CityController
{
    public function show()
    {
        $realestates = City::sortByCity($_GET['city']);
        $cities = City::selectAll();
        $totalInCity = fn ($slug) => City::sortByCity($slug);

        require 'views/index.view.php';
    }
}
