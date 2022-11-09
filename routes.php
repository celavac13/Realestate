<?php

$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

switch ($request) {

    case '':
        $homePage = new App\Controllers\IndexController;
        $homePage->index();
        break;

    case 'city':

        $realestates = new App\Controllers\CityController;
        $realestates->show();
        break;

    case 'estate':
        $realestate = new App\Controllers\RealestateController;
        $realestate->show();
        break;

    case 'login':
        $login = new App\Controllers\LoginController;
        $login->login();
        break;

    case 'logout':
        $logout = new App\Controllers\LoginController;
        $logout->logout();
        break;

    case 'register':
        $register = new App\Controllers\RegisterController;
        $register->register();
        break;

    case 'add-realestate':
        $addNew = new App\Controllers\AddRealestateController;
        $addNew->store();
        $addNew->create();
        break;

    case 'favourites':
        $favourites = new App\Controllers\FavouritesController;
        $favourites->show();
        break;

    case 'add-favourites':
        $addFavourites = new App\Controllers\FavouritesController;
        $addFavourites->addToFavourites();
        break;

    case 'remove-favourites':
        $addFavourites = new App\Controllers\FavouritesController;
        $addFavourites->removeFromFavourites();
        break;

    default:
        http_response_code(404);
        break;
}
