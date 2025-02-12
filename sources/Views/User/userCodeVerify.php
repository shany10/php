<?php if (isset($response) && !empty($response["msg"])): ?>
   <div class="<?= $response['error'] ? 'error' : 'success' ?>">
      <?php foreach ($response["msg"] as $message): ?>
         <p><?= htmlspecialchars($message) ?></p>
      <?php endforeach; ?>
   </div>
<?php endif; ?>

<form method="post">
   <input type="hidden" name="email" value="<?= htmlspecialchars($_GET['email'] ?? '') ?>">
   <label>Entrez le code reçu :</label>
   <input type="text" name="code" required>
   <button type="submit">Valider</button>
</form>