<?php
$errors = [];
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirmPassword = trim($_POST['confirm-password'] ?? '');
   
    // Validation 
    if (empty($email)) {
        $errors['email'] = "L'email est requis";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Veuillez entrer un email valide";
    }
   
    if (empty($password)) {
        $errors['password'] = "Le mot de passe est requis";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Le mot de passe doit contenir au moins 6 caractères";
    }

    if ($confirmPassword !== $password) {
        $errors['confirmPassword'] = "Le mot de passe de confirmation ne correspond pas";

    }
}
 
?>



<?php require_once 'includes/header.php'; ?>
<div class ="auth-page" id="register-page">
  <div class ="auth-container" id="register-container">
      <h2>Connexion à Find My Dream Home</h2>
      <form action="" method ='post'>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required/>

  <!-- Affichage de l'erreur pour l'email si elle existe -->
        <?php if (isset($errors['email'])): ?>
            <span class="error"><?= $errors['email']; ?></span>
        <?php endif; ?>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required/>

  <!-- Affichage de l'erreur pour le mdp si elle existe -->
        <?php if (isset($errors['password'])): ?>
            <span class="error"><?= $errors['password']; ?></span>
        <?php endif; ?>

        <label for="confirm-password">Confirmation Mot de passe</label>
        <input type="password" name="confirm-password" id="confirm-password" required/>

  <!-- Affichage de l'erreur pour le mdp si elle existe -->
        <?php if (isset($errors['confirmPassword'])): ?>
            <span class="error"><?= $errors['confirmPassword']; ?></span>
        <?php endif; ?>

        <button>Creer un compte</button>
      </form>
      <p><a href="login.php">Déjà inscrit ? Connectez-vous</a></p>
  </div>
</div>

<?php require_once 'includes/footer.php'; ?>