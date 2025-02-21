<?php if (!empty($_SESSION['user'])): ?>
    <main class="container">
        <?php include "./Views/Compenent/information.php"; ?>
        <section class="content-page">
            <h2>Bienvenue <?= ucfirst(unserialize($_SESSION['user'])->getFirstname()) ?></h2>
            <h3>Sur cette application, vous pouvez :</h3>
            <ul>
                <li>Créer des groupes</li>
                <li>Ajouter des utilisateurs à un groupe</li>
                <li>Supprimer un groupe</li>
                <li>Consulter les photos d'un groupe</li>
                <li>Uploader des photos</li>
            </ul>
        </section>
        <?php include "./Views/Compenent/detail.php"; ?>
    </main>
<?php endif; ?>