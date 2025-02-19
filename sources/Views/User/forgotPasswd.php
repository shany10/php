<div class="container reset-container">
  <h1 class="text-center">Mot de passe oublié</h1>

  <form action="/forgotPassword" method="post" class="login-form">
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
  </form>
  
  <p class="text-center">
    <a href="/login" class="link">Retour à la connexion</a>
  </p>
</div>