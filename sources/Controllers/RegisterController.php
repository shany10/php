<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\UserModel;
use App\Session\UserSession;
use App\Validator\UserValidator;
use App\Validator\DataPostValidator;
use App\Controllers\SendMailController;
use Exception;

class RegisterController
{
   public static function index(): void
   {
      $response = [
         "error" => false,
         "msg" => []
      ];

      // Vérification des champs requis
      $validationResult = DataPostValidator::validate(
         $_POST,
         ['email', 'password', 'passwordConfirm']
      );

      if ($validationResult["error"]) {
         $response["error"] = true;
         $response["msg"] = $validationResult["msg"];
      } else {
         $email = trim($_POST['email']);
         $password = $_POST['password'];
         $passwordConfirm = $_POST['passwordConfirm'];
         $verificationCode = random_int(100000, 999999);

         try {
            $user = new UserModel();

            if ($user->findOneByEmail($email)) {
               $response["error"] = true;
               $response["msg"][] = "Cet email est déjà utilisé.";
            } else {
               // Création de l'utilisateur
               $user->setEmail($email);
               $user->setPwd($password);
               $user->setVerificationCode($verificationCode);
               $user->setIsVerified(false); 

               // Validation des données utilisateur
               $validator = new UserValidator($user, $passwordConfirm);

               if (!empty($validator->getErrors())) {
                  $response["error"] = true;
                  $response["msg"] = $validator->getErrors();
               } else {
                  // Enregistrement de l'utilisateur avec le code de validation
                  $user_id = $user->saveUser();

                  if ($user_id) {
                     // Envoi de l'email de validation
                     $mailController = new SendMailController();
                     $subject = "Validation de votre compte";
                     $message = "Bonjour,<br><br>Votre code de validation est : <b>$verificationCode</b>.<br>
                                        Veuillez entrer ce code pour activer votre compte.<br><br>
                                        Merci,<br>L'équipe.";

                     if ($mailController->sendMail($email, $subject, $message)) {
                        header("Location: /verify?email=" . urlencode($email));
                        // exit();
                     } else {
                        $response["error"] = true;
                        $response["msg"][] = "Erreur lors de l'envoi du mail de validation.";
                     }
                  } else {
                     $response["error"] = true;
                     $response["msg"][] = "Erreur lors de l'enregistrement de l'utilisateur.";
                  }
               }
            }
         } catch (Exception $e) {
            $response["error"] = true;
            $response["msg"][] = "Erreur système : " . $e->getMessage();
         }
      }

      // Affichage de la vue d'inscription si erreur
      $view = new View("User/register.php", "front.php");
      $view->addData('response', $response);
   }
}
