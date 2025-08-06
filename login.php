<?php
    $errors = [];

    // Validation

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        if (empty($email)) {
            $errors['email'] = "L'email est requis";
        } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Veuillez entrer un email valide";
        }

        if (empty($password)) {
            $errors['password'] = "Le mot de passe est requis";
        } elseif (strlen($password) < 6) {
            $errors['password'] = "Le mot de passe doit contenir au moins 6 caractères";
        }
    }

?>



<?php require_once 'includes/_header.php'; ?>
<body>
  <main>
<?php require_once 'includes/_nav.php'; ?>

<div class ="auth-page" id="login-page">
  <div class ="auth-container" id="login-container">
      <h2>Connexion à Find My Dream Home</h2>
      <form action="" method ='post'>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required/>

   <!-- Affichage de l'erreur pour l'email si elle existe -->
        <?php if (isset($errors['email'])): ?>
            <span class="error"><?php echo $errors['email']; ?></span>
        <?php endif; ?>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required/>

  <!-- Affichage de l'erreur pour le mdp si elle existe -->
        <?php if (isset($errors['password'])): ?>
            <span class="error"><?php echo $errors['password']; ?></span>
        <?php endif; ?>

        <button>Se connecter</button>
      </form>
      <p><a href="register.php">Pas encore de compte ? Inscrivez-vous</a></p>
  </div>
</div>

<?php require_once 'includes/_footer.php'; ?>
