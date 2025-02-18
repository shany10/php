<h1>Add user to groupe</h1>
<?php if (!empty($messages)){ foreach($messages as $message) { ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php }} ?>
<form action="/addUserToGroup" method="post" enctype="multipart/form-data">
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