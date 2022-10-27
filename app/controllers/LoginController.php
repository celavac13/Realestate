<?php

require __DIR__ . '/../actions/LoginUser.php';
require __DIR__ . '/../actions/LogoutUser.php';

class LoginController
{
    public function login(QueryBuilder $query)
    {
        $loginUserAction = new LoginUser($query);
        $result = [];
        $errors = [];

        if ($_POST) {
            $result = $loginUserAction->validate($_POST['email'], $_POST['password']);
            if (array_key_exists(
                'userInfo',
                $result
            )) {
                $loginUserAction->login($result['userInfo']);
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
    }
}
