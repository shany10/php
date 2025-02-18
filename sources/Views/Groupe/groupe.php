<h1>Groupe</h1>
<?php if (!empty($messages)){ foreach($messages as $message) { ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php }} ?>
<form action="/createGroupe" method="post" enctype="multipart/form-data">
    <h2>Création de groupe</h2>
    <label for="photo">Crée votre groupe :</label>
    <input type="text" name="group_name" required>
    <button type="submit">Create</button>
</form>
<form action="/deleteGroupe" method="post" enctype="multipart/form-data">
    <h2>Suppression de groupe</h2>
    <label for="photo">Choisisez le groupe à supprimer :</label>
    <select name="id_groupe" required>
        <?php foreach ($groups as $group): ?>
            <option value="<?= $group['id'] ?>"><?= htmlspecialchars($group['group_name']) ?></option>
        <?php endforeach; ?>
        <option value="0">Aucun groupe</option>
    </select>
    <button type="submit">Supprimer</button>
</form>
<form action="/addUserToGroupe" method="post" enctype="multipart/form-data">
    <h2>Ajout d'utilisateur dans un groupe</h2>
    <label for="photo">Choisisez votre groupe :</label>
    <select name="id_groupe" required>
        <?php foreach ($groups as $group): ?>
            <option value="<?= $group['id'] ?>"><?= htmlspecialchars($group['group_name']) ?></option>
        <?php endforeach; ?>
        <option value="0">Aucun groupe</option>
    </select>
    <input type="text" name="email" placeholder="Email..." required>
    <button type="submit">Create</button>
</form>
