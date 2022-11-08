<?php

namespace App\Controllers;

use Core\Database\QueryBuilder;
use App\Actions\LoginUser;
use App\Actions\LogoutUser;
use PDOException;

require __DIR__ . '/../actions/LoginUser.php';
require __DIR__ . '/../actions/LogoutUser.php';

class LoginController
{
    public function login(QueryBuilder $query)
    {
        $loginUserAction = new LoginUser($query);
        $errors = [];

        if ($_POST) {
            $params = [
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];

            try {
                $result = $loginUserAction->validate($params);
            } catch (PDOException $e) {
                $errors[] = $e->getMessage();
            }

            if (array_key_exists('data', $result)) {
                $loginUserAction->login($result['data']);
                header('location: http://www.realestate.local');
            } else {
                $errors[] = $result['errors'];
            }
        }

        require 'app/views/login.view.php';
    }

    public function logout()
    {
        $logoutUserAction = new LogoutUser();
        $logoutUserAction->logout();
        header('location: http://www.realestate.local');
    }
}
