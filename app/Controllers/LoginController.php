<?php

namespace App\Controllers;

use App\Actions\LoginUser;
use App\Actions\LogoutUser;
use App\Core\Database\Connection;
use App\Core\Request;
use PDOException;

class LoginController extends Controller
{
    public function login(Connection $connection, Request $request)
    {
        $user = $this->getLoggedInUser();

        if ($user !== NULL) {
            return $this->redirect('/');
        }

        $loginUserAction = new LoginUser($connection);
        $errors = [];

        if ($_POST) {
            $params = [
                'email' => $request->post('email'),
                'password' => $request->post('password')
            ];

            try {
                $result = $loginUserAction->validate($params);
            } catch (PDOException $e) {
                $errors[] = $e->getMessage();
            }

            if (array_key_exists('data', $result)) {
                $loginUserAction->login($result['data']);
                return $this->redirect('/');
            } else {
                $errors[] = $result['errors'];
            }
        }

        require '../views/login.view.php';
    }

    public function logout()
    {
        $logoutUserAction = new LogoutUser();
        $logoutUserAction->logout($this->getLoggedInUser());
        return $this->redirect('/');
    }
}
