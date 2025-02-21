<?php if (!empty($messages)) {
    foreach ($messages as $message) { ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
<?php }
} ?>
<ul class="container" id="groupe_menu">
    <li class="m-right-2"><button id="create">Création</button></li>
    <li class="m-left-2 m-right-2"><button id="delete">Suppression</button></li>
    <li class="m-left-2"><button id="update">Ajout d'un membre</button></li>
</ul>
<form id="createGroupe" class="standar-form" action="/createGroupe" method="post" enctype="multipart/form-data">
    <h2>Création de groupe</h2>
    <label for="photo">Crée votre groupe :</label>
    <input type="text" name="group_name" required>
    <button class="button button-success" type="submit">Créer</button>
</form>
<form id="deleteGroupe" class="standar-form hidden" action="/deleteGroupe" method="post" enctype="multipart/form-data">
    <h2>Suppression de groupe</h2>
    <label for="photo">Choisisez le groupe à supprimer :</label>
    <select name="id_groupe" required>
        <?php foreach ($groups as $group): ?>
            <option value="<?= $group['id'] ?>"><?= htmlspecialchars($group['group_name']) ?></option>
        <?php endforeach; ?>
        <option value="0">Aucun groupe</option>
    </select>
    <button class="button button-danger" type="submit">Supprimer</button>
</form>
<form id="updateGroupe" class="standar-form hidden" action="/addUserToGroupe" method="post" enctype="multipart/form-data">
    <h2>Ajout d'utilisateur dans un groupe</h2>
    <label for="photo">Choisisez votre groupe :</label>
    <select name="id_groupe" required>
        <?php foreach ($groups as $group): ?>
            <option value="<?= $group['id'] ?>"><?= htmlspecialchars($group['group_name']) ?></option>
        <?php endforeach; ?>
        <option value="0">Aucun groupe</option>
    </select>
    <input type="text" name="email" placeholder="Email..." required>
    <button class="button" type="submit">Ajouter</button>
</form>
<script src="./js/groupePage.js" defer></script>