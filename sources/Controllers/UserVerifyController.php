<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\QueryBuilder;
use App\Models\UserModel;
use App\Validator\DataPostValidator;

use Exception;

class UserVerifyController
{
   public static function index(): void
   {
      $response = [
         "error" => false,
         "msg" => ""
      ];

      $dataPostValidator = DataPostValidator::validate($_POST, ['code']);

      if ($dataPostValidator["error"]) {
         $response["error"] = true;
         $response["msg"] = $dataPostValidator["msg"];
      } else {

         if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"] ?? null;
            $code = $_POST["code"] ?? null;

            // Vérification de la présence de l'email et du code
            if (!$email || !$code) {
               $response["error"] = true;
               $response["msg"][] = "Veuillez saisir l'email et le code reçu par mail.";
            } else {
               try {
                  // Requête pour vérifier l'email et le code
                  $queryBuilder = new QueryBuilder();

                  $userData = $queryBuilder
                     ->select(["id", "email"])
                     ->from("users")
                     ->where("verification_code", $code)
                     ->fetch();

                  if ($userData && isset($userData["id"])) {

                     $user = UserModel::findOneByEmail($userData["email"]);

                     if ($user && $user->getVerificationCode() == $code && !$user->isVerified()) {
                        $user->setIsVerified(true); // Utilisateur vérifié
                        $user->update();
                        $_SESSION["user"] = serialize($user);
                        unset($_SESSION["verification_code"]);
                        header("Location: /home");
                        exit;
                     } else {
                        $response["error"] = true;
                        $response["msg"][] = "Code invalide ou utilisateur déjà vérifié.";
                     }
                  } else {
                     // Code de vérification invalide
                     $response["error"] = true;
                     $response["msg"][] = "Code de vérification invalide.";
                  }
               } catch (Exception $e) {
                  $response["error"] = true;
                  $response["msg"][] = "Erreur système : " . $e->getMessage();
               }
            }
         }
      }



      if (isset($_GET['email']) && isset($_SESSION["verification_code"]) && $_SESSION["verification_code"] == $_GET['email']) {
         $view = new View("User/userCodeVerify.php", "front.php");
         $view->addData("title", "Code de validation");
         $view->addData('response', $response);
      } else {
         // Gérer l'email manquant ou invalide
         $response["error"] = true;
         $response["msg"][] = "Email invalide ou manquant.";
         // $view = new View("User/userCodeVerify.php", "front.php");
         // $view->addData('response', $response);
      }
   }
}
