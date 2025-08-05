
<?php require_once 'includes/header.php'; ?>

<?php require_once 'includes/data.php'; ?>

<div id="articles-page">
        <section>
          <h2>Nos annonces de maison</h2>
          <div id="house-container">
             <?php
            foreach ($houses as $product) {
                include "includes/createArticle.php";
            }
        ?>
          </div>
        </section>
        <section>
          <h2>Nos annonces d'appartement</h2>
          <div id="appartement-container">
          <?php
            foreach ($appartements as $product) {
                include "includes/createArticle.php";
            }
        ?>
          </div>
        </section>
</div>

<?php require_once 'includes/footer.php'; ?>
