<div class="container">
    <h2 class="text-center">Se connecter</h2>

    <?php if (!empty($errors)): ?>
        <ul class="error-list">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <form method="post" action="/login" class="login-form">
        <div class="input-wrapper">
            <i class="fas fa-envelope"></i>
            <input
                type="email"
                name="email"
                id="email"
                class="input-field"
                required
                placeholder="Entrez votre email">
        </div>

        <div class="input-wrapper">
            <i class="fas fa-lock"></i>
            <input
                type="password"
                name="password"
                id="password"
                class="input-field"
                required
                placeholder="Entrez votre mot de passe">
        </div>

        <div class="remember-me">
            <label>
                <input type="checkbox" name="remember" value="1"> Se souvenir de moi
            </label>
            <a href="/forgotPassword" class="link">Mot de passe oublié ?</a>
        </div>

        <button type="submit" class="button">Se connecter</button>
    </form>
    <p class="text-center">
        Pas encore de compte ?
        <a href="/register" class="link">Inscrivez-vous ici</a>.
    </p><br>

    <p class="text-center">
        <a href="/" class="link">Accueil</a>
    </p>
</div>