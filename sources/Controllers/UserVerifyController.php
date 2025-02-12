<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\UserModel;
use Exception;

class UserVerifyController
{
   public static function index(): void
   {
      $response = [
         "error" => false,
         "msg" => []
      ];

      if ($_SERVER["REQUEST_METHOD"] === "POST") {
         $email = $_POST["email"] ?? null;
         $code = $_POST["code"] ?? null;

         if (!$email || !$code) {
            $response["error"] = true;
            $response["msg"][] = "Veuillez saisir le code à 6 chifres reçu par mail.";
         } else {
            try {
               $user = UserModel::findOneByEmail($email);
               if ($user && $user->getVerificationCode() == $code && !$user->isVerified()) {
                  $user->setIsVerified(true); // utilisateur vérifié
                  $user->update();
                  header("Location: /login");
               } else {
                  $response["error"] = true;
                  $response["msg"][] = "Code invalide ou utilisateur introuvable.";
               }
            } catch (Exception $e) {
               $response["error"] = true;
               $response["msg"][] = "Erreur système : " . $e->getMessage();
            }
         }
      }

      if (isset($_GET['email']) && filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
         $view = new View("User/userCodeVerify.php", "front.php");
         $view->addData('response', $response);
      } else {
         echo "Email invalide ou manquant.";
      }
   }
}
