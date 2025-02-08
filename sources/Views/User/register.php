<?php if (!empty($errors)): ?>
  <ul>
    <?php foreach ($errors as $error): ?>
      <li><?= htmlspecialchars($error) ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<form action="/register" method="POST">
  <input type="email" name="email" placeholder="Votre email" required><br>
  <input type="password" name="password" placeholder="Votre mot de passe" required minlength="6"><br>
  <input type="password" name="passwordConfirm" placeholder="Confirmation" required minlength="6"><br>
  <input type="submit" value="S'inscrire"><br>
</form>
<p>Déjà un compte ? <a href="/login">Connectez-vous ici</a>.</p>
<p><a href="/">Accueil</a>.</p>