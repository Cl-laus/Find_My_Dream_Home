<?php session_start(); ?>
<?php require_once 'includes/_header.php'; ?>
<?php require_once 'includes/_pdo_connect.php'; ?>

<?php
    // Récupérer l'ID et le role de l'utilisateur connecté, recuperés dans login

    $user_id   = $_SESSION['id'];
    $user_role = $_SESSION['role'];

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $articleId = trim($_GET['id']);
    } else {
        // id manquant -> redirection ou message d'erreur
        $_SESSION['error_message'] = "ID de l'annonce manquant.";
        header('Location: index.php');
        exit;
    }
    // recuperes les datas avec l'id correspondant
    $sql = 'SELECT l.*,
                   pt.name AS property_type,
                   tt.name AS transaction_type
            FROM listing l
            JOIN propertyType pt ON l.property_type_id = pt.id
            JOIN transactionType tt ON l.transaction_type_id = tt.id
            WHERE l.id = :articleId';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':articleId', $articleId, PDO::PARAM_INT); // securise
    $stmt->execute();

    $product = $stmt->fetch();

    if (empty($_SESSION['isLoggedIn']) || ! ($user_role === "admin" || $user_id === $product['user_id'])) {
        //  redirection si pas les droits de modifier
        $_SESSION['error_message'] = "Vous devez être connecté en tant qu' admin ou etre le créateur pour modifier cette annonce.";
        header('Location: index.php');
        exit;
    } else {

    }
?>





<body>
    <main>
        <?php require_once 'includes/_nav.php'; ?>

        <div class="add-page" id="add-page">
            <div class="add-container" id="add-container">
                <h2>New Add</h2>
                <!-- Affichage du message d'envoi si pas d'erreurs -->

                <p class="validMsg"><?php echo $success ?? '' ?></p>

                <form action="" method="post">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" minlength="5" maxlength="50" required
                        value="<?php echo $product['title'] ?? ''; ?>">
                    <!-- Affichage de l'erreur -->
                    <span class="error" id="titleError">
                        <?php echo $errors['title'] ?? '' ?>
                    </span>

                    <label for="imageUpload">URL image:</label>
                    <input type="text" id="image_url" name="image_url" required
                        value="<?php echo $product['image_url'] ?? ''; ?>">
                    <!-- Affichage de l'erreur -->
                    <span class="error" id="UrlError">
                        <?php echo $errors['url'] ?? '' ?>
                    </span>


                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" step="50" required
                        value="<?php echo $product['price'] ?? ''; ?>">
                    <!-- Affichage de l'erreur -->
                    <span class="error" id="priceError">
                        <?php echo $errors['price'] ?? '' ?>
                    </span>

                    <label for="location">Ville:</label>
                    <input type="text" id="location" name="location" required
                        value="<?php echo $product['location'] ?? ''; ?>">
                    <!-- Affichage de l'erreur -->
                    <span class="error" id="locationError">
                        <?php echo $errors['location'] ?? '' ?>
                    </span>

                    <label for="description">Description:</label>
                    <textarea name="description" rows="4" cols="50" minlength="1" maxlength="255"
                        required><?php echo $product['description'] ?? ''; ?></textarea>
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