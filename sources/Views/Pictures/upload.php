<h1>Upload de photo</h1>
<?php if (isset($message)): ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<form action="/upload" method="post" enctype="multipart/form-data">
    <label for="photo">Sélectionnez une photo :</label>
    <input type="file" name="photo" id="photo" required>
    <button type="submit">Uploader</button>
</form>