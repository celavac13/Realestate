<?php

namespace App\Actions;

class LogoutUser extends Action
{
    public function logout()
    {
        if (isset($_SESSION['user']['username'])) {
            session_destroy();
        }
    }
}
