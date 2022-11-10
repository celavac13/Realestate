<?php

namespace App\Controllers;

use App\Actions\RegisterUser;
use PDO;
use PDOException;

class RegisterController extends Controller
{
    public function register(PDO $connection)
    {
        $registerUserAction = new RegisterUser($connection);
        $errors = [];

        if ($_POST) {
            $params = [
                'username' => $_POST['username'],
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ];
            $result = $registerUserAction->validate($params);

            if (array_key_exists('validate', $result)) {
                try {
                    $registerUserAction->register($_POST['username'], $_POST['name'], $_POST['email'], $_POST['password']);
                    return $this->redirect('/');
                } catch (PDOException $e) {
                    $errors[] = $e->getMessage();
                }
            } else {
                $errors[] = $result['errors'];
            }
        }
        require '../views/register.view.php';
    }
}
