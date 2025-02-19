<?php

namespace App\Controllers;

use App\Core\View;
use App\Controllers\SendMailController;

class ForgotPasswdController
{
    public static function index(): void
    {
        $view = new View("User/forgotPasswd.php", "front.php");
        $view->addData("title", "Mot de passe oublié");
    }

    public static function requestReset(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
            $email = $_POST['email'];
            $subject = "Mot de passe oublié";
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));


            $queryBuilder = new \App\Core\QueryBuilder();

            // Insérer un nouveau token
            $queryBuilder->insert("password_resets", [
                "email" => $email,
                "token" => $token,
                "expires_at" => $expiry
            ])->execute();

            // Lien de réinitialisation
            $resetLink = "https://phpotographie.ninja/resetPassword?token=" . $token;

            // Contenu du mail
            $content = "Bonjour,<br><br>
            Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe : <br><br>
            <a href='$resetLink'>Réinitialiser mon mot de passe</a> <br><br>
            Ce lien est valide pour 1 heure.";

            // Envoyer l'e-mail
            $mailer = new SendMailController();
            if ($mailer->sendMail($email, $subject, $content)) {
                echo "E-mail envoyé avec succès à $email.";
            } else {
                echo "Erreur lors de l'envoi de l'e-mail.";
            }
        }
    }
}
