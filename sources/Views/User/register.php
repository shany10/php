<div class="container">
    <h1 class="text-center">Créer un compte</h1>



    <form action="/register" method="POST" class="login-form">
        <div class="input-wrapper">
            <i class="fas fa-user"></i>
            <input
                type="text"
                name="firstname"
                id="firstname"
                class="input-field"
                required
                placeholder="Prénom"
                value="<?= htmlspecialchars($_POST['firstname'] ?? '') ?>">
        </div>
        <div class="input-wrapper">
            <i class="fas fa-user"></i>
            <input
                type="text"
                name="lastname"
                id="lastname"
                class="input-field"
                required
                placeholder="Nom"
                value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>">
        </div>
        <div class="input-wrapper">
            <i class="fas fa-globe"></i>
            <input
                type="text"
                name="country"
                id="country"
                class="input-field"
                required
                placeholder="Pays"
                value="<?= htmlspecialchars($_POST['country'] ?? '') ?>">
        </div>
        <div class="input-wrapper">
            <i class="fas fa-envelope"></i>
            <input
                type="email"
                name="email"
                id="email"
                class="input-field"
                required
                placeholder="Votre email"
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div class="input-wrapper">
            <i class="fas fa-lock"></i>
            <input
                type="password"
                name="password"
                id="password"
                class="input-field"
                required
                placeholder="Mot de passe"
                minlength="6">
        </div>
        <div class="input-wrapper">
            <i class="fas fa-lock"></i>
            <input
                type="password"
                name="passwordConfirm"
                id="passwordConfirm"
                class="input-field"
                required
                placeholder="Confirmez le mot de passe"
                minlength="6">
        </div>
        <?php if (!empty($errors)): ?>
            <ul class="error-list">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <button type="submit" class="button">S'inscrire</button>
    </form>
    <p class="text-center">
        Déjà un compte ?
        <a href="/login" class="link">Connectez-vous ici</a>.
    </p>
</div>