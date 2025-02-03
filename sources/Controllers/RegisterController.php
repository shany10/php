<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\UserModel;
use App\Session\UserSession;
use App\Validator\UserValidator;
use App\Validator\DataPostValidator;

class RegisterController
{
  public static function index(): void
  {
    $response = DataPostValidator::validate(
        $_POST,
        [
            'email',
            'password',
            'passwordConfirm',
        ],
    ); //Verifie si les champs existe et le nombre d'agument requise

    if ($response["error"] === false) {
      
        $user = new UserModel(); // la table user le champ email est unique, voir userMigration.php et le ficher Readme
        $user->setEmail($_POST['email']);
        $user->setPwd($_POST['password']);
     
        $validator = new UserValidator($user, $_POST['passwordConfirm']); //valide les données de chaque champ
       
        if (empty($validator->getErrors())) {

            $user_id = $user->save(); //retur un id
           
            if ($user_id != 0) {

                $isStarted = UserSession::startUserSession($user_id, $user->getEmail());
                if($isStarted) {
                    header("Location: /");
                    return;
                }
                $response['msg'][] = "Problème de session";
            }

            $response['msg'][] = "Mail est déjà utilser";
        } else {
          $response['msg'] = $validator->getErrors();
        }
    }
    $view = new View("User/register.php", "front.php");
    $view->addData('errors', $response["msg"]);
    return;
  }
}
