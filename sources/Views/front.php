<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./dist/main.css">
</head>

<body>
    <?php if (
        $_SERVER["REQUEST_URI"] != "/login" &&
        $_SERVER["REQUEST_URI"] != "/register" &&
        $_SERVER["REQUEST_URI"] != "/forgotPassword" &&
        !strpos($_SERVER["REQUEST_URI"], "/resetPassword") &&
        $_SERVER["REQUEST_URI"] != "/verify" &&
        $_SERVER["REQUEST_URI"] != "/"
    ): ?>
        <?php include "./Views/Compenent/navbar.php"; ?>
    <?php endif; ?>
    <?php include $this->view; ?>
</body>

</html>