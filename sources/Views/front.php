<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="./dist/main.css">
</head>

<body>
    <?php include "./Views/Compenent/navbar.php"; ?>
    <?php include $this->view; ?>
</body>

</html>