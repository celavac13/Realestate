<?php

namespace App\Controllers;

use App\Cache\CacheInterface;
use App\Models\City;
use App\Models\Realestate;

class IndexController extends Controller
{
    public function index(CacheInterface $cache)
    {
        //proveravamo da li u cacheu postoji ovaj key sa vrednostima
        $realestates = $cache->get(Realestate::CACHE_KEY_ALL);
        if (!$realestates) {
            $realestates = Realestate::all();
            //setujemo ovaj key sa vrednostima u cacheu, sa experation time-om 
            $cache->set(Realestate::CACHE_KEY_ALL, $realestates, Realestate::CACHE_EXPIRATION);
        }

        $cities = City::all();
        $totalInCity = fn ($slug) => City::findBySlug($slug)->getRealestates();

        require '../views/index.view.php';
    }
}
