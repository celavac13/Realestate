<?php

namespace App\Controllers;

use App\Core\Database\QueryBuilder;
use App\Core\Request;
use App\Models\City;

class CityController extends Controller
{
    public function show(Request $request)
    {
        $realestates = City::findBySlug($request->get('city'))->getRealestates();
        $cities = City::all();
        $totalInCity = fn ($slug) => City::findBySlug($slug)->getRealestates();

        require '../views/index.view.php';
    }
}
