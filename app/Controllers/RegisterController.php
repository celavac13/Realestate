<?php

namespace App\Controllers;

use App\Actions\RegisterUser;
use App\Core\Database\Connection;
use App\Core\Request;
use App\Core\Response;
use PDOException;

class RegisterController extends Controller
{
    public function register(Connection $connection, Request $request, Response $response): Response
    {
        $registerUserAction = new RegisterUser($connection);
        $errors = [];

        if ($_POST) {
            $params = [
                'username' => $request->post('username'),
                'name' => $request->post('name'),
                'email' => $request->post('email'),
                'password' => $request->post('password')
            ];
            $result = $registerUserAction->validate($params);

            if (array_key_exists('validate', $result)) {
                try {
                    $registerUserAction->register($request->post('username'), $request->post('name'), $request->post('email'), $request->post('password'));
                    return $response->redirect('/');
                } catch (PDOException $e) {
                    $errors[] = $e->getMessage();
                }
            } else {
                $errors[] = $result['errors'];
            }
        }

        $response->data(['errors' => $errors])->view('register');
    }
}
