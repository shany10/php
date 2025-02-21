<?php if (!empty($_SESSION['user'])): ?>
    <h2>Bienvenue <?= ucfirst(unserialize($_SESSION['user'])->getFirstname()) ?></h2>
    <p>Vous êtes connecté en tant que <?= unserialize($_SESSION['user'])->getRole() ?></p>
    <p>Votre email est <?= unserialize($_SESSION['user'])->getEmail() ?></p>
    <h3>Sur cette application, vous pouvez :</h3>
    <ul class="container">
        <li>Créer des groupes</li>
        <li>Ajouter des utilisateurs à un groupe</li>
        <li>Supprimer un groupe</li>
        <li>Consulter les photos d'un groupe</li>
        <li>Uploader des photos</li>
    </ul>
<?php endif; ?>