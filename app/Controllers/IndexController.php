<?php

namespace App\Controllers;

use App\Models\City;
use App\Models\Realestate;

class IndexController
{
    public function index()
    {
        $realestates = Realestate::all();
        $cities = City::all();
        $totalInCity = fn ($slug) => City::findBySlug($slug)->getRealestates();

        require 'views/index.view.php';
    }
}
