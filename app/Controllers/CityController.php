<?php

namespace App\Controllers;

use App\Core\Database\QueryBuilder;
use App\Models\City;

class CityController
{
    public function show()
    {
        $realestates = City::findBySlug($_GET['city'])->getRealestates();
        $cities = City::all();
        $totalInCity = fn ($slug) => City::findBySlug($slug)->getRealestates();

        require 'views/index.view.php';
    }
}
