<h1>Ma galerie de photos</h1>

<?php echo $pictures; ?>

<?php if (isset($pictures) && $pictures > 0): ?>
    <div class="gallery">
        <?php foreach ($pictures as $picture): ?>
            <div class="picture">
                <img src="<?= htmlspecialchars($picture['file_path']) ?>" alt="<?= htmlspecialchars($photo['file_name']) ?>" />
                <p><?= htmlspecialchars($picture['file_name']) ?></p>
                <a href="/pictures/delete/<?= htmlspecialchars($picture['id']) ?>">Supprimer</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucune photo téléchargée.</p>
<?php endif; ?>