<?php

use App\Controllers\CityController;
use App\Controllers\FavouritesController;
use App\Controllers\IndexController;
use App\Controllers\LoginController;
use App\Controllers\RealestateController;
use App\Controllers\RegisterController;

return [
    '' => [IndexController::class, 'index'],
    'city' => [CityController::class, 'show'],
    'estate' => [RealestateController::class, 'show'],
    'login' => [LoginController::class, 'login'],
    'logout' => [LoginController::class, 'logout'],
    'register' => [RegisterController::class, 'register'],
    'add-realestate-post' => [RealestateController::class, 'store'],
    'add-realestate' => [RealestateController::class, 'create'],
    'favourites' => [FavouritesController::class, 'show'],
    'add-favourites' => [FavouritesController::class, 'addToFavourites'],
    'remove-favourites' => [FavouritesController::class, 'removeFromFavourites'],
    'edit' => [RealestateController::class, 'edit'],
    'update' => [RealestateController::class, 'update']
];

// $container->call($routes[$request]);

// switch ($request) {

//     case '':
//         // $homePage = new App\Controllers\IndexController;
//         // $homePage->index($cache);
//         $container->call([IndexController::class, 'index']);
//         break;

//     case 'city':

//         $realestates = new App\Controllers\CityController;
//         $realestates->show();
//         break;

//     case 'estate':
//         $realestate = new App\Controllers\RealestateController;
//         $realestate->show($cache);
//         break;

//     case 'login':
//         $login = new App\Controllers\LoginController;
//         $login->login($connection);
//         break;

//     case 'logout':
//         $logout = new App\Controllers\LoginController;
//         $logout->logout();
//         break;

//     case 'register':
//         $register = new App\Controllers\RegisterController;
//         $register->register($connection);
//         break;

//     case 'add-realestate':
//         $addNew = new App\Controllers\RealestateController;
//         $addNew->store($cache);
//         $addNew->create();
//         break;

//     case 'favourites':
//         $favourites = new App\Controllers\FavouritesController;
//         $favourites->show();
//         break;

//     case 'add-favourites':
//         $addFavourites = new App\Controllers\FavouritesController;
//         $addFavourites->addToFavourites();
//         break;

//     case 'remove-favourites':
//         $addFavourites = new App\Controllers\FavouritesController;
//         $addFavourites->removeFromFavourites();
//         break;

//     case 'edit':
//         $editRealestate = new App\Controllers\RealestateController;
//         $editRealestate->edit();
//         break;

//     case 'update':
//         $editRealestate = new App\Controllers\RealestateController;
//         $editRealestate->update($cache);
//         break;

//     default:
//         http_response_code(404);
//         break;
// }
