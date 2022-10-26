<?php
require __DIR__ . '/../actions/RegisterUser.php';

class RegisterController
{
    public function register(QueryBuilder $query)
    {
        $registerUserAction = new RegisterUser($query);
        $errors = [];

        if ($_POST) {
            $errors = $registerUserAction->register($_POST['username'], $_POST['name'], $_POST['email'], $_POST['password']);
        }
        require 'app/views/register.view.php';
    }
}
