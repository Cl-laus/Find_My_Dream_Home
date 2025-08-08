<?php session_start(); ?>
<?php require_once 'includes/_header.php'; ?>
<?php require_once 'includes/_pdo_connect.php'; ?>
<!-- <script src="script/check_auth.js" defer></script> -->




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
     

        if(empty($errors)){
               // Préparer lA DATE AU FORMAT SQL
            $now = date('Y-m-d H:i:s');

            $stmt = $pdo->prepare("
                INSERT INTO user
                (email, password, created_at, updated_at)
                VALUES
                (:email, :password, :created_at, :updated_at)
                ");
            // LIE LES VALEURS, pour secure
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password );
          
            $stmt->bindValue(':created_at', $now);
            $stmt->bindValue(':updated_at', $now);
            // envoie des données
            $stmt->execute();

            $success = "Votre compte a bien été enregistrée.";
        }
    }

?>



<body>
    <main>
        <?php require_once 'includes/_nav.php'; ?>


        <div class="auth-page" id="register-page">
            <div class="auth-container" id="register-container">
                <h2>Connexion à Find My Dream Home</h2>
                <!-- Affichage du message d'envoi si pas d'erreurs -->
                <p class="validMsg">
                    <?php echo $success ?? '' ?>
                </p>


                <form action="" method='post'>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required />
                    <!-- Affichage de l'erreur -->

                    <span class="error" id="emailError">
                        <?php echo $errors['email'] ?? '' ?>
                        <!-- affiche l'erreur"email" si elle est presente. Sinon chaine vide -->
                    </span>



                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required />


                    <!-- Affichage de l'erreur -->
                    <span class="error" id="passwordError">
                        <?php echo $errors['password'] ?? '' ?>
                    </span>


                    <label for="confirm-password">Confirmation Mot de passe</label>
                    <input type="password" name="confirm-password" id="confirm-password" required />


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