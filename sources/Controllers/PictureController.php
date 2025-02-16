<?php
namespace App\Controllers;
use App\Core\View;
use App\Models\Group;
use App\Models\Pictures;

class PictureController
{
    public static function upload(): void
    {
        // Vérification si la méthode est POST et si un fichier photo est soumis
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["photo"])) {
            $uploadDir = __DIR__ . "/../public/uploads/";
            $groupId = $_POST["groupe"];
            $user = unserialize($_SESSION["user"]);
            $userId = $user->getId();
            $file = $_FILES["photo"];
            $message = "";

            // Vérification du type de fichier
            $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
            if (!in_array($file["type"], $allowedTypes)) {
                $message = "Format non supporté ! Seules les images JPEG, PNG, GIF sont autorisées.";
            }

            // Vérification de la taille du fichier (< 5MB)
            elseif ($file["size"] > 5 * 1024 * 1024) {
                $message = "Fichier trop volumineux ! La taille maximale est de 5 Mo.";
            }

            // Création du dossier si inexistant
            elseif (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Sécurisation du nom du fichier (éviter les collisions de noms)
            else {
                $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);
                $fileName = uniqid("photo_") . "." . $fileExtension; // Utilisation d'un nom unique
                $filePath = $uploadDir . $fileName;

                // Déplacement du fichier
                if (move_uploaded_file($file["tmp_name"], $filePath)) {
                    $message = "Upload réussi !";
                } else {
                    $message = "Erreur lors de l'upload. Veuillez réessayer.";
                }
            }

            // Si l'upload a réussi, enregistrer le chemin du fichier dans la base de données
            if ($message === "Upload réussi !") {
                // Validation du groupId
                if (!is_numeric($groupId) || $groupId <= 0) {
                    $message = "Groupe invalide.";
                } else {
                    $picture = new Pictures();
                    $picture->uploadPicture($userId, $groupId, $filePath);
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


    public static function delete($pictureId, $userId, $group_id, $isOwner): void
    {
        Pictures::getPictureById($pictureId);
        if (!$pictureId) {
            $_SESSION['message'] = "Photo introuvable.";
            header("Location: /gallery");
            exit;
        }
        $filePath = __DIR__ . "/../public/uploads/" . $pictureId['file_name'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        Pictures::deletePicture($pictureId, $userId, $group_id, $isOwner);
        $_SESSION['message'] = "Photo supprimée.";
        header("Location: /gallery");
        exit();
    }
    public static function showForm()
    {
        // Récupérer tous les groupes
        $groups = Group::getAllGroups();
        $view = new View("Pictures/upload.php", "front.php");
        $view->addData("groups", $groups);
        return;
    }
}
