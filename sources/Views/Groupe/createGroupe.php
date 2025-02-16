<h1>Create groupe</h1>
<?php if (!empty($messages)){ foreach($messages as $message) { ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php }} ?>
<form action="/createGroupe" method="post" enctype="multipart/form-data">
    <label for="photo">Crée votre groupe :</label>
    <input type="text" name="group_name" required>
    <button type="submit">Create</button>
</form>