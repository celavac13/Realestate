<?php

class LogoutUser
{
    public function logout()
    {
        if (isset($_SESSION['username'])) {
            session_destroy();
            header('location: http://www.realestate.local');
            exit();
        }
    }
}
