<?php

namespace App\Controllers;

use App\Actions\LoginUser;
use App\Actions\LogoutUser;
use App\Core\Database\Connection;
use App\Core\Request;
use App\Core\Response;
use PDOException;

class LoginController extends Controller
{
    public function login(Connection $connection, Request $request, Response $response): Response
    {
        $user = $this->getLoggedInUser();

        if ($user !== NULL) {
            return $response->redirect('/');
        }

        $loginUserAction = new LoginUser($connection, $request);
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
                return $response->redirect('/');
            } else {
                $errors[] = $result['errors'];
            }
        }

        return $response->data(['errors' => $errors])->view('login');
    }

    public function logout(Response $response): Response
    {
        $logoutUserAction = new LogoutUser();
        $logoutUserAction->logout($this->getLoggedInUser());
        return $response->redirect('/');
    }
}
