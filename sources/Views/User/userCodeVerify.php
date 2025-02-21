<div class="container">
   <form method="post" class="login-form">
      <h1 class="text-center">Code de validation</h1>
      <input type="hidden" name="email" value="<?= htmlspecialchars($_GET['email'] ?? '') ?>">
      <input
         type="text"
         name="code"
         class="input-field"
         placeholder="Entrez le code"
         required>
      <?php if (!empty($response['error'])): ?>
         <ul class="message-box danger-color">
            <li><?= htmlspecialchars($response['msg']) ?></li>
         </ul>
      <?php else: ?>
         <ul class="message-box info-color">
            <li>Un code de validation à 6 chiffres a été envoyé à votre adresse e-mail. Veuillez le saisir pour activer votre compte.</li>
         </ul>
      <?php endif; ?>
      <button type="submit" class="button">Valider</button>
   </form>
</div>