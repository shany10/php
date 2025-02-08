<?php
namespace App\Controllers;
use App\Core\View;
use App\Models\Pictures;

class PictureController
{
    public static function upload()
    {
        // Vérification si la méthode est POST et si un fichier photo est soumis
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["photo"])) {
            $uploadDir = "public/uploads/";
            $file = $_FILES["photo"];
            $message = "";

            // Vérification du type de fichier
            $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
            if (!in_array($file["type"], $allowedTypes)) {
                $message = "Format non supporté !";
            }

            // Vérification de la taille du fichier (< 5MB)
            elseif ($file["size"] > 5 * 1024 * 1024) {
                $message = "Fichier trop volumineux !";
            }

            // Création du dossier si inexistant
            elseif (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Déplacement du fichier
            else {
                $filePath = $uploadDir . basename($file["name"]);
                if (move_uploaded_file($file["tmp_name"], $filePath)) {
                    $message = "Upload réussi !";
                } else {
                    $message = "Erreur lors de l'upload.";
                }
            }

            // Passer le message à la vue avec addData
            $view = new View("Pictures/upload.php", "front.php");
            $view->addData("message", $message);
            return;
        }

        // Si ce n'est pas une requête POST ou aucun fichier n'est soumis, afficher la vue de l'upload
        $view = new View("Pictures/upload.php", "front.php");
        return;
    }

    public static function delete($pictureId)
    {
        Pictures::getOneById($pictureId);
        if (!$pictureId) {
            $_SESSION['message'] = "Photo introuvable.";
            header("Location: /gallery");
            exit;
        }
        $filePath = __DIR__ . "/../public/uploads/" . $pictureId['file_name'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        Pictures::delete($pictureId);
        $_SESSION['message'] = "Photo supprimée.";
        header("Location: /gallery");
        exit();
    }
}
