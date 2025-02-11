<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\UserModel;
use Exception;

namespace App\Controllers;

use App\Core\View;
use App\Models\UserModel;
use Exception;

class UserVerifyController
{
   public static function index(): void
   {
 
      $view = new View("User/userCodeVerify.php", "front.php");

   }
}
