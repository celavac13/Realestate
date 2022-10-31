<?php

$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

switch ($request) {

    case '':
    case '/':
        require 'app/controllers/index.php';
        break;

    case 'city':
        require 'app/controllers/CityController.php';
        $realestates = new CityController;
        $realestates->show($query, $cities, $totalInCity);
        break;

    case 'estate':
        require 'app/controllers/RealestateController.php';
        $realestate = new RealestateController;
        $realestate->show($query, $cities, $totalInCity);
        break;

    case 'login':
        require 'app/controllers/LoginController.php';
        $login = new LoginController;
        $login->login($query);
        break;

    case 'logout':
        require 'app/controllers/LoginController.php';
        $logout = new LoginController;
        $logout->logout();
        break;

    case 'register':
        require 'app/controllers/RegisterController.php';
        $register = new RegisterController;
        $register->register($query);
        break;

    case 'add-realestate':
        require 'app/controllers/AddRealestateController.php';
        $addNew = new AddRealestateController;
        $addNew->store($query);
        $addNew->create($cities);
        break;

    case 'favourites':
        require 'app/controllers/FavouritesController.php';
        $favourites = new FavouritesController;
        $favourites->show($query);
        break;

    default:
        http_response_code(404);
        require 'app/views/404.php';
        break;
}
