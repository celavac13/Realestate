<?php

class LogoutUser
{
    public function logout()
    {
        session_start();
        if (isset($_SESSION['username'])) {
            session_destroy();
            header('location: http://www.realestate.local');
            exit();
        }
    }
}
