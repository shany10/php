<section class="detail-page">
    <h3>Liste des groupes</h3>
    <ul>
        <?php foreach ($groupes as $groupe) : ?>
            <li>
                <a href="/gallery?groupe_id=<?= $groupe['id'] ?>"><?= $groupe['group_name'] ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>