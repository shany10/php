<h2>Galerie du groupe</h2>
<?php if (!empty($pictures)): ?>
    <div class="gallery">
        <?php foreach ($pictures as $picture): ?>
            <div class="photo">
                <img src="<?= $picture['file_path'] ?>" alt="Photo de groupe">
                <?php if ($_SESSION['user_id'] == $picture['user_id'] || $_SESSION['user_role'] === 'owner'): ?>
                    <form action="/delete" method="post">
                        <input type="hidden" name="photo_id" value="<?= $picture['id'] ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucune photo trouvée.</p>
<?php endif; ?>