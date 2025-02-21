<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./dist/main.css">
</head>

<body>
    <?php
    // Condition pour afficher la navbar 
    $excludedRoutes = ["/login", "/register", "/forgotPassword", "/resetPassword", "/verify"];
    if (!in_array($_SERVER["REQUEST_URI"], $excludedRoutes)):
    ?>
        <?php include "./Views/Compenent/navbar.php"; ?>
    <?php endif; ?>

    <!-- Contenu de la page -->
    <?php include $this->view; ?>

    <!-- Footer toujours affiché après la vue -->
    <?php
    if (!in_array($_SERVER["REQUEST_URI"], $excludedRoutes)):
    ?>
        <?php include "./Views/Compenent/footer.php"; ?>
    <?php endif; ?>
</body>

</html>