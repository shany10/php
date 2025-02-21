<?php if (!empty($pictures)): ?>
    <div class="gallery">
        <?php foreach ($pictures as $picture): ?>
            <div class="photo">
                <img class="rounded-top" src="<?= "../public/uploads/" . $picture['file_name'] ?>" alt="Photo de groupe">
               
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucune photo trouvée.</p>
<?php endif; ?>
