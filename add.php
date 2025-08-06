<?php
    $errors = [];

    // Validation

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title            = trim($_POST['title'] ?? '');
        $imageUpload      = trim($_POST['imageUpload'] ?? '');
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
        if (empty($imageUpload)) {
            $errors['url'] = "L'URL de l'image est requise";
            // validation de l'url
        } elseif (! filter_var($imageUpload, FILTER_VALIDATE_URL)) {
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
        } elseif (strlen($location) < 5) {
            $errors['description'] = "la description n'est pas conforme";
        }
        if (empty($property_type)) {
            $errors['property_type'] = "selectionner un type";
        }
        if (empty($transaction_type)) {
            $errors['transaction_type'] = "selectionner un type";
        }

    }

?>



<?php require_once 'includes/_header.php'; ?>
<body>
  <main>
<?php require_once 'includes/_nav.php'; ?>
<div class ="add-page" id="add-page">
  <div class ="add-container" id="add-container">
      <h2>New Add</h2>
      <!-- Affichage du message d'envoi si pas d'erreurs -->
     <?php if (empty($errors)): ?>
    <p class="validMsg">Votre annonce est en cours de traitement.</p>
<?php endif; ?>
          <form action="" method="post">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" minlength="5" maxlength="50" required>
                     <!-- Affichage de l'erreur -->
                      <span class="error" id="titleError">
                        <?php echo $errors['title'] ?? '' ?>
                      </span>

                    <label for="imageUpload">URL image:</label>
                    <input type="text" id="imageUpload" name="imageUpload" required>
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
                        <option value="House">House</option>
                        <option value="Appartement">Appartement</option>
                    </select>

                    <label for="transaction_type">Type de transaction:</label>
                    <select id="transaction_type" name="transaction_type" required>
                        <option value="" disabled selected hidden>--select type--</option>
                        <option value="Rent">Rent</option>
                        <option value="Sale">Sale</option>
                    </select>

                     <button type="submit">Enregistrer</button>
         </form>
  </div>
</div>



<?php require_once 'includes/_footer.php'; ?>
