<?php if (isset($message)): ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>
<main class="container">
    <?php include "./Views/Compenent/information.php"; ?>
    <section class="content-page">
        <form class="standar-form" action="/upload" method="post" enctype="multipart/form-data">
            <label for="photo">Sélectionnez une photo :</label>
            <input type="file" name="photo" id="photo" accept="image/*" required>

            <label for="groupe">Choisissez un groupe :</label>
            <select name="groupe" required>
                <?php foreach ($groups as $group): ?>
                    <option value="<?= $group['id'] ?>"><?= htmlspecialchars($group['group_name']) ?></option>
                <?php endforeach; ?>
                <option value="0">Aucun groupe</option>
            </select>

            <label for="partage">Niveau de partage :</label>
            <select name="partage">
                <option value="groupe">Groupe</option>
                <option value="public">Public</option>
                <option value="prive">Privé</option>
            </select>
            <button class="button" type="submit">Download</button>
        </form>
    </section>
    <?php include "./Views/Compenent/detail.php"; ?>
</main>