<?php

use LDAP\Result;

require __DIR__ . '/../actions/RegisterUser.php';

class RegisterController
{
    public function register(QueryBuilder $query)
    {
        $registerUserAction = new RegisterUser($query);
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
                    header('location: http://www.realestate.local');
                } catch (PDOException $e) {
                    $errors[] = $e->getMessage();
                }
            } else {
                $errors[] = $result['errors'];
            }
        }
        require 'app/views/register.view.php';
    }
}
