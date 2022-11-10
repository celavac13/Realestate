<?php

namespace App\Controllers;

class Controller
{

    public function getLoggedInUser()
    {
        return $_SESSION['user']['id'];
    }
}
