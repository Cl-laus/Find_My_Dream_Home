<?php require_once 'includes/_data.php'; ?>

<?php require_once 'includes/_header.php'; ?>

<body>
  <main>
<?php require_once 'includes/_nav.php'; 


?>
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
