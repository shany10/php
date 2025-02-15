<?php

namespace App\Session;

use Exception;

class UserSession
{
    static public function startUserSession(int $id, string $email): bool
    {
        try {
            session_start();
            $_SESSION['user_id'] = $id;
            $_SESSION['user_email'] = $email;

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}