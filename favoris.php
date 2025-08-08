<?php session_start(); ?>
<?php require_once 'includes/_header.php'; ?>
<?php require_once 'includes/_pdo_connect.php'; ?>

<?php
    $user_id = $_SESSION['id'];

    // requete sql pour recuperer les annonces

    $sql = "SELECT l.*,
               pt.name AS property_type,
               tt.name AS transaction_type
        FROM listing l
        JOIN favoris f ON l.id = f.listing_id
        JOIN propertyType pt ON l.property_type_id = pt.id
        JOIN transactionType tt ON l.transaction_type_id = tt.id
        WHERE f.user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    $products = $stmt->fetchAll();

    //compte le nombres d'annonces pour afficher les messgaes d'erreur
    $houseCount = 0;
    $appCount   = 0;

    // Compter les maisons et appartements
    foreach ($products as $product) {
        if ($product['property_type'] === 'house') {
            $houseCount++;
        } elseif ($product['property_type'] === 'appartment') {
            $appCount++;
        }
    }

    // Messages d'erreur si aucun favori
    $_houseError = ($houseCount == 0) ? "Vous n'avez pas de maisons favorites." : '';
    $_appError   = ($appCount == 0) ? "Vous n'avez pas d'appartements favoris." : '';
?>

<body>
    <main>
        <?php require_once 'includes/_nav.php'; ?>


        <div id="articles-page">
            <section>
                <h2>Vos annonces de maison</h2>
                <span class="error">
                    <?php
                        echo $_houseError ?? '';
                    ?>
                </span>

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
                <h2>Vos annonces d'appartement</h2>
                <span class="error">
                    <?php
                        echo $_appError ?? '';
                    ?>
                </span>
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