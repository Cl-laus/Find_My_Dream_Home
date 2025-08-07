<?php require_once 'includes/_data.php'; ?>

<?php require_once 'includes/_header.php'; ?>

<?php require_once 'includes/_pdo_connect.php';

    $sql      = 'SELECT
    l.title,
    l.description,
    l.city,
    l.image_url,
    l.price,
    pt.name AS property_type,
    tt.name AS transaction_type
FROM listing l
JOIN propertyType pt ON l.property_type_id = pt.id
JOIN transactionType tt ON l.transaction_type_id = tt.id;';
    $stmt     = $pdo->query($sql);
    $products = $stmt->fetchAll();
    // var_dump($products);
?>
<body>
  <main>

  <?php require_once 'includes/_nav.php'; ?>

<div id="articles-page">
        <section>
          <h2>Nos annonces de maison</h2>
          <div id="house-container">
             <?php
                 foreach ($products as $product) {
                     include "includes/_createArticle.php";
                 }
             ?>
          </div>
        </section>
        <section>
          <h2>Nos annonces d'appartement</h2>
          <div id="appartement-container">
          <?php
              foreach ($appartements as $product) {
                  include "includes/_createArticle.php";
              }
          ?>
          </div>
        </section>
</div>

<?php require_once 'includes/_footer.php'; ?>
    </main>
  </body>
</html>
