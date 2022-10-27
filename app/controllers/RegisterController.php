<?php

use LDAP\Result;

require __DIR__ . '/../actions/RegisterUser.php';

class RegisterController
{
    public function register(QueryBuilder $query)
    {
        $registerUserAction = new RegisterUser($query);
        $result = [];
        $errors = [];

        if ($_POST) {
            $result = $registerUserAction->validate($_POST['username'], $_POST['name'], $_POST['email'], $_POST['password']);

            if (array_key_exists(
                'params',
                $result
            )) {
                $registerUserAction->register($result['params']);
            } else {
                $errors[] = $result['errors'];
            }
        }
        require 'app/views/register.view.php';
    }
}
