<h1>Upload de photo</h1>
<?php if (isset($message)): ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form action="/upload" method="post" enctype="multipart/form-data">
    <label for="photo">Sélectionnez une photo :</label>
    <input type="file" name="photo" id="photo" accept="image/*" required>
    
    <label for="groupe">Choisissez un groupe :</label>
    <select name="groupe" required>
    </select>

    <label for="partage">Niveau de partage :</label>
    <select name="partage">
        <option value="groupe">Groupe</option>
        <option value="public">Public</option>
        <option value="prive">Privé</option>
    </select>

    <button type="submit">Uploader</button>
</form>
