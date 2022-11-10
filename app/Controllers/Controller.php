<?php

namespace App\Controllers;

class Controller
{

    public function getLoggedInUser()
    {
        if (isset($_SESSION['user']['id'])) {
            return $_SESSION['user']['id'];
        } else {
            return false;
        }
    }
}
