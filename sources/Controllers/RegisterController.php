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
    if(!empty($_SESSION["user"])) {
      header("Location: /");
      return;
    }
    $response = DataPostValidator::validate(
      $_POST,
      [
        'email',
        'firstname',
        'lastname',
        'country',
        'password',
        'passwordConfirm',
      ],
    ); //Verifie si les champs existe et le nombre d'agument requise

    if ($response["error"] === false) {

      $user = new UserModel(); // la table user le champ email est unique, voir userMigration.php et le ficher Readme
      $user->setEmail($_POST['email']);
      $user->setPwd($_POST['password']);
      $user->setFirstname($_POST['firstname']);
      $user->setLastname($_POST['lastname']);
      $user->setCountry($_POST['country']);

      $validator = new UserValidator($user, $_POST['passwordConfirm']); //valide les données de chaque champ

      if (empty($validator->getErrors())) {

        $user_id = $user->save(); //retur un id

        if ($user_id != 0) {
          $_SESSION["user"] = $user;
          header("Location: /");
          return;
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
