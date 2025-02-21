<section class="information-page">
    <p>Vous êtes connecté en tant que <?= unserialize($_SESSION['user'])->getRole() ?></p>
    <p>Votre email est <?= unserialize($_SESSION['user'])->getEmail() ?></p>
</section>