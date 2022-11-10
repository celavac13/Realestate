<?php

$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

switch ($request) {

    case '':
        $homePage = new App\Controllers\IndexController;
        $homePage->index($client);
        break;

    case 'city':

        $realestates = new App\Controllers\CityController;
        $realestates->show();
        break;

    case 'estate':
        $realestate = new App\Controllers\RealestateController;
        $realestate->show($client);
        break;

    case 'login':
        $login = new App\Controllers\LoginController;
        $login->login($connection);
        break;

    case 'logout':
        $logout = new App\Controllers\LoginController;
        $logout->logout();
        break;

    case 'register':
        $register = new App\Controllers\RegisterController;
        $register->register($connection);
        break;

    case 'add-realestate':
        $addNew = new App\Controllers\RealestateController;
        $addNew->store($client);
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

    case 'edit':
        $editRealestate = new App\Controllers\RealestateController;
        $editRealestate->edit();
        break;

    case 'update':
        $editRealestate = new App\Controllers\RealestateController;
        $editRealestate->update($client);
        break;

    default:
        http_response_code(404);
        break;
}
