<?php

namespace App\Controllers;

use App\Models\City;
use App\Models\Realestate;

class IndexController
{
    public function index()
    {
        $realestates = Realestate::selectAll();
        $cities = City::selectAll();
        $totalInCity = fn ($slug) => City::sortByCity($slug);

        require 'views/index.view.php';
    }
}
