<?php session_start(); ?>
<?php require_once 'includes/_header.php'; ?>
<?php require_once 'includes/_pdo_connect.php'; ?>


<?php
    // Vérifie si l'utilisateur est connecté, sinon valeurs nulles
    $user_id   = $_SESSION['id'] ?? null;
    $user_role = $_SESSION['role'] ?? null;


$articlePerPage = 12;

    // <!-- requete sql pour recuperer les annonces -->

    $sql = 'SELECT l.*,
    pt.name AS property_type,
    tt.name AS transaction_type
FROM listing l
JOIN propertyType pt ON l.property_type_id = pt.id
JOIN transactionType tt ON l.transaction_type_id = tt.id
WHERE pt.name = "house"
ORDER BY l.created_at DESC
-- limit $articlePerPage 
    ;'

    ;
    $stmt   = $pdo->query($sql);
    $houses = $stmt->fetchAll();

?>

<body>
    <main>
        <?php require_once 'includes/_nav.php'; ?>

        <span class="error">
            <!-- affiche un message d'erreur si on a pas les droits d'acces -->

        </span>

        <div id="articles-page">
            <section>
                <h2>Nos annonces de maison</h2>
                <div id="house-container">
                    <?php
                        foreach ($houses as $product) {

                            include "includes/_createArticle.php";

                        }
                    ?>
                </div>
            </section>
        </div>
        <div class="button-nav-container">
            <button class="button-nav">Precedent</button>
            <button class="button-nav">Suivant</button>
        </div>
        <?php require_once 'includes/_footer.php'; ?>
    </main>
</body>

</html>