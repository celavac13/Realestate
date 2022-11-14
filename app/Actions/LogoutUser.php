<?php

namespace App\Actions;

use App\Models\User;

class LogoutUser
{
    public function logout(?User $user)
    {
        if ($user) {
            session_destroy();
        }
    }
}
