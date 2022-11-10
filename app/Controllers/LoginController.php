<?php

namespace App\Controllers;

use App\Actions\LoginUser;
use App\Actions\LogoutUser;
use PDOException;

class LoginController extends Controller
{
    public function login()
    {
        $user = $this->getLoggedInUser();

        if ($user) {
            header('location: http://www.realestate.local');
        }

        $loginUserAction = new LoginUser();
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

        require 'views/login.view.php';
    }

    public function logout()
    {
        $logoutUserAction = new LogoutUser();
        $logoutUserAction->logout();
        header('location: http://www.realestate.local');
    }
}
