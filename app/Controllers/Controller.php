<?php

namespace App\Controllers;

use App\Models\User;

abstract class Controller
{
    public function getLoggedInUser(): ?User
    {
        if (isset($_SESSION['user']['id'])) {
            return User::find($_SESSION['user']['id']);
        }
        return NULL;
    }
}
