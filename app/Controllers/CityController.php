<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Models\City;

class CityController extends Controller
{
    public function show(Request $request, Response $response): Response
    {
        $realestates = City::findBySlug($request->get('city'))->getRealestates();
        $cities = City::all();
        $totalInCity = fn ($slug) => City::findBySlug($slug)->getRealestates();

        return $response->data(['realestates' => $realestates, 'cities' => $cities, 'totalInCity' => $totalInCity, 'this' => $this])->view('index');
    }
}
