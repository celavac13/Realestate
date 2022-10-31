<?php

class LogoutUser
{
    public function logout()
    {
        if (isset($_SESSION['user']['username'])) {
            session_destroy();
        }
    }
}
