<?php require_once 'includes/_header.php'; ?>
<!-- <script src="script/check_auth.js" defer></script> -->
<body>
    <main>

<?php require_once 'includes/_nav.php'; ?>


<?php
    $errors = [];
    // Validation

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email           = trim($_POST['email'] ?? '');
        $password        = trim($_POST['password'] ?? '');
        $confirmPassword = trim($_POST['confirm-password'] ?? '');

        if (empty($email)) {
            $errors['email'] = "L'email est requis";
        } elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Veuillez entrer un email valide";
        }

        if (empty($password)) {
            $errors['password'] = "Le mot de passe est requis";
        } elseif (strlen($password) < 8) {
            $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères";
        }

        if ($confirmPassword !== $password) {
            $errors['confirmPassword'] = "Le mot de passe de confirmation ne correspond pas";

        }
        if (empty($errors)) {
            $errors['Status'] = "Votre annonce est en cours de traitement.";
        }

    }

?>



<div class ="auth-page" id="register-page">
  <div class ="auth-container" id="register-container">
      <h2>Connexion à Find My Dream Home</h2>
     <!-- Affichage du message d'envoi si pas d'erreurs -->
    <p class="validMsg">
        <?php echo $errors['Status'] ?? '' ?>
    </p>


      <form action="" method ='post'>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required/>
        <!-- Affichage de l'erreur -->

            <span class="error" id="emailError">
                <?php echo $errors['email'] ?? '' ?>
                <!-- affiche l'erreur"email" si elle est presente. Sinon chaine vide -->
            </span>



        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required/>


  <!-- Affichage de l'erreur -->
            <span class="error" id="passwordError">
                <?php echo $errors['password'] ?? '' ?>
            </span>


        <label for="confirm-password">Confirmation Mot de passe</label>
        <input type="password" name="confirm-password" id="confirm-password" required/>


  <!-- Affichage de l'erreur pour le mdp si elle existe -->

         <span class="error" id="confirmPasswordError">
                <?php echo $errors['confirmPassword'] ?? '' ?>
            </span>

        <button>Creer un compte</button>
      </form>
      <p><a href="login.php">Déjà inscrit ? Connectez-vous</a></p>
  </div>
</div>

<?php require_once 'includes/_footer.php'; ?>




    </main>
  </body>
</html>
