<?php

class LogoutUser
{
    public function logout()
    {
        if (isset($_SESSION['username'])) {
            session_destroy();
        }
    }
}
