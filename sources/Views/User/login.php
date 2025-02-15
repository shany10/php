<h2> Se connecter </h2>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<form method="post" action="/login">
    <!-- <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>"> -->
    <label>Email :</label>
    <input type="email" name="email" required>
    <label>Mot de passe :</label>
    <input type="password" name="password" required>

    <label>
        <input type="checkbox" name="remember" value="1"> Se souvenir de moi
    </label>

    <a href="/forgotPassword">Mot de passe oublié ?</a>

    <button type="submit">Se connecter</button>
</form>

<p>Pas encore de compte ? <a href="/register">Inscrivez-vous ici</a>.</p>
<p><a href="/">Accueil</a>.</p>