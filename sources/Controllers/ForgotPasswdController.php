<?php

namespace App\Controllers;

use App\Core\View;
use App\Controllers\SendMailController;
use \App\Core\QueryBuilder;
use App\Validator\DataPostValidator;

class ForgotPasswdController
{
    public static function index(array $response = []): void
    {
        $view = new View("User/forgotPasswd.php", "front.php");
        $view->addData("title", "Mot de passe oublié");
        $view->addData("response", $response);
    }

    public static function requestReset(): void
    {
        $response = DataPostValidator::validate($_POST, ['email']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
            $email = $_POST['email'];

            $queryBuilder = new QueryBuilder();

            $user_id = $queryBuilder
                ->select(["id"])
                ->from("users")
                ->where("email", $email)
                ->fetch();

            if ($user_id) {

                $queryBuilder->reset();

                $token = bin2hex(random_bytes(32));
                $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

                // Insérer un nouveau token
                $queryBuilder->insert("password_resets", [
                    "email" => $email,
                    "token" => $token,
                    "expires_at" => $expiry
                ])->execute();

                $resetLink = "https://phpotographie.ninja/resetPassword?token=" . $token; // Lien de réinitialisation

                $subject = "Mot de passe oublié"; // Objet

                // Contenu du mail
                $content = "Bonjour,<br><br>
                Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe : <br><br>
                <a href='$resetLink'>Réinitialiser mon mot de passe</a> <br><br>
                Ce lien est valide pour 1 heure.";

                // Envoyer l'e-mail
                $mailer = new SendMailController();
                if ($mailer->sendMail($email, $subject, $content)) {
                    $response['success'] = "Un e-mail a été envoyé à $email avec un lien de réinitialisation.";
                } else {
                    $response['error'] = "Erreur lors de l'envoi de l'e-mail.";
                }
            } else {
                $response['error'] = "Cette adresse e-mail n'existe pas.";
            }
        }
        self::index($response);
    }
}
