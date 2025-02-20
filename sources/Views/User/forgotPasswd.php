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
    <p class="form-info">
      Nous vous enverrons un lien pour réinitialiser votre mot de passe.
    </p>
    <button type="submit" class="button">Réinitialiser mon mot de passe</button>
    <p class="text-center">
      <a href="/login" class="link">Retour à la connexion</a>
    </p>
  </form>


</div>