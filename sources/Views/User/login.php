<div class="container">
    <form method="post" action="/login" class="login-form">
        <h1 class="text-center">Se connecter</h1>
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
        <?php if (!empty($errors)): ?>
            <ul class="message-box danger-color">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div class="forgotPwd">
            <a href="/forgotPassword" class="link">Mot de passe oublié ?</a>
        </div>
        <button type="submit" class="button">Se connecter</button>
        <p class="text-center">
            Pas encore de compte ?
            <a href="/register" class="link">Inscrivez-vous ici</a>.
        </p>
    </form>
</div>