<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="/register" method="POST">
    <input
        type="email"
        name="email"
        placeholder="Votre email"
        <?php echo (!empty($_POST['email']) ? "value='" . $_POST['email'] . "'" : "") ?>
        required><br>
    <input
        type="text"
        name="firstname"
        placeholder="Firstname..."
        <?php echo (!empty($_POST['firstname']) ? "value='" . $_POST['firstname'] . "'" : "") ?>
        required><br>
    <input
        type="text"
        name="lastname"
        placeholder="Lastname..."
        <?php echo (!empty($_POST['lastname']) ? "value='" . $_POST['lastname'] . "'" : "") ?>
        required><br>
    <input 
        type="text" 
        name="country" 
        placeholder="Country..." 
        <?php echo (!empty($_POST['country']) ? "value='" . $_POST['country'] . "'" : "") ?>        
        required><br>
    <input type="password" name="password" placeholder="Votre mot de passe" required minlength="6"><br>
    <input type="password" name="passwordConfirm" placeholder="Confirmation" required minlength="6"><br>
    <input type="submit" value="S'inscrire"><br>
</form>
<p>Déjà un compte ? <a href="/login">Connectez-vous ici</a>.</p>
<p><a href="/">Accueil</a>.</p>