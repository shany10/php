<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

class SendMailController
{
   private PHPMailer $mail;

   public function __construct()
   {
      $this->mail = new PHPMailer(true);
      $this->configureSMTP();
   }

   private function configureSMTP(): void
   {
      try {
         // Server settings
         $this->mail->SMTPDebug = 0; // Activer le mode débogage
         $this->mail->isSMTP();                       // Envoyer via SMTP
         $this->mail->Host       = 'smtp.gmail.com';  // Serveur SMTP
         $this->mail->SMTPAuth   = true;              // Activer l'authentification SMTP
         $this->mail->Username   = 'sylvainanton77@gmail.com'; // Nom d'utilisateur SMTP
         $this->mail->Password   = 'rhuzhkhnkmzkgkso'; // Mot de passe SMTP
         $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Chiffrement TLS
         $this->mail->Port       = 465;               // Port SMTP sécurisé

         $this->mail->setFrom('sylvainanton77@gmail.com', 'Projet php');
      } catch (Exception $e) {
         echo "Erreur SMTP : {$this->mail->ErrorInfo}";
      }
   }

   public function sendMail(string $mailToSend, $subject, string $content): bool
   {
      try {
         // Ajouter le destinataire
         $this->mail->addAddress($mailToSend);

         // Contenu de l'email
         $this->mail->isHTML(true);
         $this->mail->CharSet = 'UTF-8';
         $this->mail->Subject = "{$subject}";
         $this->mail->Body    = "<b>{$content}</b>";
         $this->mail->AltBody = strip_tags($content);

         // Envoyer l'email
         $this->mail->send();
         return true;
      } catch (Exception $e) {
         echo "Erreur d'envoi : {$this->mail->ErrorInfo}";
         return false;
      }
   }
}
