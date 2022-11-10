<?php

namespace App\Controllers;

use App\Models\City;
use App\Models\Realestate;
use Predis\Client;

class IndexController extends Controller
{
    public function index(Client $client)
    {
        //proveravamo da li u cacheu postoji ovaj key sa vrednostima
        $realestates = unserialize($client->get(Realestate::CACHE_KEY_ALL));
        if (!$realestates) {
            $realestates = Realestate::all();
            //setujemo ovaj key sa vrednostima u cacheu, sa experation time-om 
            //$client->set(keyName, value, 'EX', expirationTimeInSeconds)
            $client->set(Realestate::CACHE_KEY_ALL, serialize($realestates), 'EX', Realestate::CACHE_EXPIRATION);
        }

        $cities = City::all();
        $totalInCity = fn ($slug) => City::findBySlug($slug)->getRealestates();

        require '../views/index.view.php';
    }
}
