<?php

require __DIR__ . '/../actions/LoginUser.php';
require __DIR__ . '/../actions/LogoutUser.php';

class LoginController
{
    public function login(QueryBuilder $query)
    {
        $loginUserAction = new LoginUser($query);
        $errors = [];

        if ($_POST) {
            $errors = $loginUserAction->login($_POST['email'], $_POST['password']);
        }
        require 'app/views/login.view.php';
    }

    public function logout()
    {
        $logoutUserAction = new LogoutUser();
        $logoutUserAction->logout();
    }
}
