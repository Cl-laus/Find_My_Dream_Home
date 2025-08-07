<?php require_once 'includes/_header.php'; ?>
<body>
  <main>
<?php require_once 'includes/_nav.php'; ?>

<?php
    $errors = [];

    // Validation

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title            = trim($_POST['title'] ?? '');
        $image_url     = trim($_POST['image_url'] ?? '');
        $price            = trim($_POST['price'] ?? '');
        $location         = trim($_POST['location'] ?? '');
        $description      = trim($_POST['description'] ?? '');
        $property_type    = $_POST['property_type'] ?? '';
        $transaction_type = $_POST['transaction_type'] ?? '';

        if (empty($title)) {
            $errors['title'] = "Un titre est requis";
        } elseif ((strlen($title) < 2) || ((strlen($title) > 50))) {
            $errors['title'] = "Le titre est trop court ou trop long";
        }
        if (empty($image_url)) {
            $errors['url'] = "L'URL de l'image est requise";
            // validation de l'url
        } elseif (! filter_var($image_url, FILTER_VALIDATE_URL)) {
            $errors['url'] = "L'URL fournie n'est pas valide";
        }
        if (empty($price)) {
            $errors['price'] = "Le prix est requis";
        } elseif ((int) $price <= 0) {
            $errors['price'] = "Le prix doit être un entier positif";
        }
        if (empty($location)) {
            $errors['location'] = "Une ville est requis";
        } elseif ((strlen($location) < 2) || ((strlen($location) > 50))) {
            $errors['location'] = "l'entrée n'est pas valide";
        }

        if (empty($description)) {
            $errors['description'] = "Une description est requis";
        } elseif (strlen($description) < 5) {
            $errors['description'] = "la description n'est pas conforme";
        }
        if (empty($property_type)) {
            $errors['property_type'] = "selectionner un type";
        }
        if (empty($transaction_type)) {
            $errors['transaction_type'] = "selectionner un type";
        }
        if (empty($errors)) {
         
            require_once 'includes/db.php'; // fichier de connexion PDO

            $stmt = $pdo->prepare("INSERT INTO listing (title, image_url, price, location, description, property_type, transaction_type)
              VALUES (:title, :image_url , :price, :location, :description, :property_type, :transaction_type)");

            $stmt->bindValue(':title', $title );
            $stmt->bindValue(':image_url', $image_url );
            $stmt->bindValue(':price', $price );
            $stmt->bindValue(':location', $location );
            $stmt->bindValue(':description', $description );
            $stmt->bindValue(':property_type', $property_type );
            $stmt->bindValue(':transaction_type', $transaction_type );

            $stmt->execute();

             $success = "Votre annonce a bien été enregistrée.";
        }
    }

?>



<div class ="add-page" id="add-page">
  <div class ="add-container" id="add-container">
      <h2>New Add</h2>
      <!-- Affichage du message d'envoi si pas d'erreurs -->
    
    <p class="validMsg"><?php echo $success ?? '' ?></p>

          <form action="" method="post">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" minlength="5" maxlength="50" required>
                     <!-- Affichage de l'erreur -->
                      <span class="error" id="titleError">
                        <?php echo $errors['title'] ?? '' ?>
                      </span>

                    <label for="imageUpload">URL image:</label>
                    <input type="text" id="image_url" name="image_url" required>
                        <!-- Affichage de l'erreur -->
                      <span class="error" id="UrlError">
                        <?php echo $errors['url'] ?? '' ?>
                      </span>


                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" step="50"required>
                        <!-- Affichage de l'erreur -->
                      <span class="error" id="priceError">
                        <?php echo $errors['price'] ?? '' ?>
                      </span>

                    <label for="location">Ville:</label>
                    <input type="text" id="location" name="location" required>
                        <!-- Affichage de l'erreur -->
                      <span class="error" id="locationError">
                        <?php echo $errors['location'] ?? '' ?>
                      </span>

                    <label for="description">Description:</label>
                    <textarea name="description" rows="4" cols="50" minlength="1"
                        maxlength="255" required></textarea>
                            <!-- Affichage de l'erreur -->
                      <span class="error" id="descriptionError">
                        <?php echo $errors['description'] ?? '' ?>
                      </span>

                    <label for="property_type">Type de propriété:</label>
                    <select id="property_type" name="property_type" required>
                        <option value="" disabled selected hidden>--select type--</option>
                        <option value="1">House</option>
                        <option value="2">Appartement</option>
                    </select>

                    <label for="transaction_type">Type de transaction:</label>
                    <select id="transaction_type" name="transaction_type" required>
                        <option value="" disabled selected hidden>--select type--</option>
                        <option value="1">Sale</option>
                        <option value="2">Rent</option>
                    </select>

                     <button type="submit">Enregistrer</button>
         </form>
  </div>
</div>



<?php require_once 'includes/_footer.php'; ?>
