<h1>Home page</h1>
<?php if(!empty($_SESSION['user'])) : ?>
    <h2>Welcome <?= unserialize($_SESSION['user'])->getFirstname() ?></h2>
    <h3>Groupes</h3>
    <ul>
        <?php foreach($groupes as $groupe) : ?>
            <li>
                <a href="/gallery?groupe_id=<?= $groupe['id'] ?>"><?= $groupe['group_name'] ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="/createGroupe" style="display: block;">Create Groupe</a>
    <a href="/addUserToGroup" style="display: block;">Add friend to groupe</a>
    <a href="/upload" style="display: block;">Upload photo</a>
    <a href="/logout" style="display: block;">Logout</a>
<?php endif; ?>  