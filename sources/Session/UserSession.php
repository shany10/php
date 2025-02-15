<?php

namespace App\Session;

use App\Models\UserModel;
use Exception;

class UserSession
{
    static public function startUserSession(UserModel $user): bool
    {
        try {
            session_start();
            $_SESSION['user'] = $user;
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}