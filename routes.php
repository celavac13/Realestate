<?php

$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

switch ($request) {

    case '':
    case '/':
        $homePage = new App\Controllers\IndexController;
        $homePage->index($query);
        break;

    case 'city':

        $realestates = new App\Controllers\CityController;
        $realestates->show($query, $cities, $totalInCity);
        break;

    case 'estate':
        $realestate = new App\Controllers\RealestateController;
        $realestate->show($query, $cities, $totalInCity);
        break;

    case 'login':
        $login = new App\Controllers\LoginController;
        $login->login($query);
        break;

    case 'logout':
        $logout = new App\Controllers\LoginController;
        $logout->logout();
        break;

    case 'register':
        $register = new App\Controllers\RegisterController;
        $register->register($query);
        break;

    case 'add-realestate':
        $addNew = new App\Controllers\AddRealestateController;
        $addNew->store($query);
        $addNew->create($cities);
        break;

    case 'favourites':
        $favourites = new App\Controllers\FavouritesController;
        $favourites->show();
        break;

    case 'add-favourites':
        $addFavourites = (new App\Controllers\FavouritesController)->handleFavourites();
        $addFavourites->addToFavourites();
        break;

    case 'remove-favourites':
        $addFavourites = (new App\Controllers\FavouritesController)->handleFavourites();
        $addFavourites->removeFromFavourites();
        break;

    default:
        http_response_code(404);
        break;
}
