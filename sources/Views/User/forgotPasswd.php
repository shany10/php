<div class="container reset-container">
  <form action="/forgotPassword" method="post" class="login-form">
    <h1 class="text-center">Mot de passe oublié</h1>
    <div class="input-wrapper">
      <i class="fas fa-envelope"></i>
      <input
        type="email"
        id="email"
        name="email"
        class="input-field"
        placeholder="Entrez votre e-mail"
        required>
    </div>
    <?php if (!empty($response['success'])): ?>
      <ul class="message-box success-color">
        <li><?= htmlspecialchars($response['success']) ?></li>
      </ul>
    <?php elseif (!empty($response['error'])): ?>
      <ul class="message-box danger-color">
        <li><?= htmlspecialchars($response['error']) ?></li>
      </ul>
    <?php else: ?>
      <ul class="message-box info-color">
        <li>Nous vous enverrons un lien pour réinitialiser votre mot de passe.</li>
      </ul>
    <?php endif; ?>
    <button type="submit" class="button">Réinitialiser mon mot de passe</button>
    <p class="text-center">
      <a href="/login" class="link">Retour à la connexion</a>
    </p>
  </form>
</div>