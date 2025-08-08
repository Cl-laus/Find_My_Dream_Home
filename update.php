<?php session_start(); ?>
<?php require_once 'includes/_header.php'; ?>
<?php require_once 'includes/_pdo_connect.php'; ?>

<?php
    // Récupérer l'ID et le role de l'utilisateur connecté, recuperés dans login

    $user_id   = $_SESSION['id'];
    $user_role = $_SESSION['role'];
    $articleId = $_GET['id'];

    // Vérifier si l'utilisateur à les droits

    if (empty($_SESSION['isLoggedIn']) || ! ($user_role === "admin" || $user_id === $product['user_id'])) {
        //  redirection si pas les droits de modifier
        $_SESSION['index_message'] = "Vous devez être connecté en tant qu' admin ou etre le créateur pour modifier cette annonce.";
        header('Location: index.php');
        exit;

    }

    // Récupérer property et transaction type dans la BDD, pour l'injecter plus bas dans le HTML
    $sql           = "SELECT id, name FROM propertytype";
    $stmt          = $pdo->query($sql);
    $propertyTypes = $stmt->fetchAll();

    $sql              = "SELECT id, name FROM transactiontype";
    $stmt             = $pdo->query($sql);
    $transactionTypes = $stmt->fetchAll();

    // recuperes les datas avec l'id correspondant pour les injecter dans le HTML
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

    $title            = $product['title'];
    $image_url        = $product['image_url'];
    $price            = $product['price'];
    $location         = $product['location'];
    $description      = $product['description'];
    $property_type    = $product['property_type_id'];
    $transaction_type = $product['transaction_type_id'];

?>


<!-- RENVOI A LA BDD APRES MODIFICATION FAITES PAR LE USER -->


<?php
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title            = trim($_POST['title'] ?? '');
       //l'URL de l'image est recuperer dans _sendImage
        $price            = trim($_POST['price'] ?? '');
        $location         = trim($_POST['location'] ?? '');
        $description      = trim($_POST['description'] ?? '');
        $property_type    = $_POST['property_type'] ?? '';
        $transaction_type = $_POST['transaction_type'] ?? '';


        // Validation des valeurs externalisé

        require 'includes/_validationFORM.php';

        // envoi de l'image avec la gestion de ses erreurs

      if (!empty($_FILES['image']['name'])) //Si l’utilisateur n’a rien mis, alors name est vide 
      {require 'includes/_sendImage.php';
        // $dest sstdéfini dans _sendImage.php
} else {
    // Pas de nouvelle image ; on garde l'ancien chemin
    $dest = $product['image_url'];
}
        
        // update DES DONNEES SI PAS ERREURS

        if (empty($errors)) {

            // Préparer lA DATE AU FORMAT SQL
            $now = date('Y-m-d H:i:s');

            $stmt = $pdo->prepare("
                UPDATE listing SET
        title = :title,
        description = :description,
        price = :price,
        location = :location,
        image_url = :image_url,
        property_type_id = :property_type_id,
        transaction_type_id = :transaction_type_id,
        updated_at = :updated_at
    WHERE id = :articleId
                ");
            // LIE LES VALEURS, pour secure
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':price', $price, PDO::PARAM_INT);
            $stmt->bindValue(':location', $location);
            $stmt->bindValue(':image_url', $dest);//recuperé dans _sendImage
            $stmt->bindValue(':property_type_id', $property_type, PDO::PARAM_INT);
            $stmt->bindValue(':transaction_type_id', $transaction_type, PDO::PARAM_INT);
            $stmt->bindValue(':articleId', $articleId, PDO::PARAM_INT);

            $stmt->bindValue(':updated_at', $now);
            // envoie des données
            $stmt->execute();

            // Maj des données dans le HTML si l'utilsateur veut continuer les modifs

            $sql = 'SELECT l.*,
               pt.name AS property_type,
               tt.name AS transaction_type
        FROM listing l
        JOIN propertyType pt ON l.property_type_id = pt.id
        JOIN transactionType tt ON l.transaction_type_id = tt.id
        WHERE l.id = :articleId';

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':articleId', $articleId, PDO::PARAM_INT);
            $stmt->execute();
            $product = $stmt->fetch();

            // PETIT MSG DE valid

            $_SESSION['successUpdate'] = "Votre annonce a bien été update.";
        }
    }
?>



<!-- ////////////////////HTML //////////////////////-->


<body>
    <main>
        <?php require_once 'includes/_nav.php'; ?>

        <div class="add-page" id="add-page">
            <div class="add-container" id="add-container">
                <h2>Mettre à jour</h2>
                <!-- Affichage du message d'envoi si pas d'erreurs -->

                <p class="validMsg">
                    <?php
                        if (! empty($_SESSION['successUpdate'])) {
                            echo $_SESSION['successUpdate'];
                            unset($_SESSION['successUpdate']);
                        }
                    ?>
                </p>

                <form action="" method="post" enctype="multipart/form-data">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" minlength="5" maxlength="50" required
                        value="<?php echo $product['title'] ?? ''; ?>">
                    <!-- Affichage de l'erreur -->
                    <span class="error" id="titleError">
                        <?php echo $errors['title'] ?? '' ?>
                    </span>

                      <label for="imageUpload">Image:</label>
                    <input type="file" name="image" id="imageUpload">
                    <!-- Affichage de l'erreur -->
                    <span class="error" id="imageError">
                        <?php echo $errors['image'] ?? '' ?>
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
                        <?php foreach ($propertyTypes as $type): ?>
                        <option value="<?php echo $type['id']; ?>"
                            <?php if ($property_type === $type['id']) {
                                    echo "selected";
                            }
                            // le select est un parametre de la balise select,option?>>

                            <?php echo strtolower($type['name']); // formatage en minuscule ?>
                        </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="transaction_type">Type de transaction:</label>
                    <select id="transaction_type" name="transaction_type" required>
                        <option value="" disabled selected hidden>--select type--</option>
                        <?php foreach ($transactionTypes as $type): ?>
                        <option value="<?php echo $type['id']; ?>"
                            <?php if ($transaction_type === $type['id']) {
                                    echo "selected";
                            }
                            ?>>

                            <?php echo strtolower($type['name']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit">Enregistrer</button>
                </form>
            </div>
        </div>



        <?php require_once 'includes/_footer.php'; ?>