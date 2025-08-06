<?php
    $errors = [];

    // Validation des champs

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
        } elseif (strlen($password) < 8) {
            $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères";
        }
        
        // verifiction des ID(TEMPORAIRE/ a lier une bdd plus tard)
        if (empty($errors)) {
            if ($email == "admin@gmail.com" && $password == "motdepasse") {
                $_SESSION['isLoggedIn'] = true;
                header('Location: index.php');
                exit;
            }else{
                $errors['loggedIn'] ="les identifiants sont incorrects";
            }
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
        <!-- Affichage de l'erreur si IDs pas correct avec la BDD-->
            <span class="error" id="emailError">
                <?php echo $errors['loggedIn'] ?? '' ?>
                
            </span>
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


        <button>Se connecter</button>
      </form>
      <p><a href="register.php">Pas encore de compte ? Inscrivez-vous</a></p>
  </div>
</div>

<?php require_once 'includes/_footer.php'; ?>
