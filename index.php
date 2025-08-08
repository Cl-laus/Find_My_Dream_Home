<?php session_start(); ?>
<?php require_once 'includes/_header.php'; ?>
<?php require_once 'includes/_pdo_connect.php'; ?>


<?php
// Vérifie si l'utilisateur est connecté, sinon valeurs nulles
$user_id   = $_SESSION['id'] ?? null;
$user_role = $_SESSION['role'] ?? null;
// <!-- requete sql pour recuperer les annonces -->
    $sql = 'SELECT l.*,
    pt.name AS property_type,
    tt.name AS transaction_type
FROM listing l
JOIN propertyType pt ON l.property_type_id = pt.id
JOIN transactionType tt ON l.transaction_type_id = tt.id;';
    $stmt     = $pdo->query($sql);
    $products = $stmt->fetchAll();
    // var_dump($products);
    // var_dump($_SESSION['id']);
?>

<body>
    <main>
        <?php require_once 'includes/_nav.php'; ?>

        <span class="error" >
         <!-- affiche un message d'erreur si on a pas les droits d'acces -->
           <?php echo $_SESSION['index_message'] ?? '';
           unset($_SESSION['index_message']); ?>
       </span>

        <div id="articles-page">
            <section>
                <h2>Nos annonces de maison</h2>
                <div id="house-container">
                    <?php
                        foreach ($products as $product) {
                            if ($product['property_type'] === 'house') {
                                include "includes/_createArticle.php";
                            }
                        }
                    ?>
                </div>
            </section>
            <section>
                <h2>Nos annonces d'appartement</h2>
                <div id="appartement-container">
                    <?php
                        foreach ($products as $product) {
                            if ($product['property_type'] === 'appartment') {
                                include "includes/_createArticle.php";
                            }
                        }
                    ?>
                </div>
            </section>
        </div>

        <?php require_once 'includes/_footer.php'; ?>
    </main>
</body>

</html>