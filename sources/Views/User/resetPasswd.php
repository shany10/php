<div class="container reset-container">
   <h1 class="text-center">Réinitialisation du mot de passe</h1>
   <form method="POST" class="login-form">
      <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
      <div class="input-wrapper">
         <i class="fas fa-envelope"></i>
         <input
            type="password"
            id="password"
            name="new_password"
            class="input-field"
            placeholder="Entrez votre nouveau mot de passe"
            required>
      </div>
      <button type="submit" class="button">Réinitialiser</button>
   </form>
</div>