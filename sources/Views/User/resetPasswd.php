<h2>Réinitialisation du mot de passe</h2>
<form method="POST">
   <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

   <label>Nouveau mot de passe :</label>
   <input type="password" name="new_password" required>

   <button type="submit">Réinitialiser</button>
</form>