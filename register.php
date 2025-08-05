<?php require_once 'includes/header.php'; ?>
<div id="login-page">
  <div class="login-container">
      <h2>Connexion à Find My Dream Home</h2>
      <form action="">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required/>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required/>
        <label for="password">confirmation Mot de passe</label>
        <input type="password" name="password" id="password" required/>

        <button>Creer un compte</button>
      </form>
      <p><a href="login.php">Déjà inscrit ? Connectez-vous</a></p>
  </div>
</div>
<?php require_once 'includes/footer.php'; ?>