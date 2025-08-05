

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agence Immobiliere</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>

    <?php include 'data.php'; ?>


    <main>
      <nav>
        <h1>Find My Dream Home</h1>
        <div id="links">
          <div class="link">Login</div>
          <div class="link">House</div>
          <div class="link">Appartement</div>
        </div>
      </nav>
      <div id="articles">
        <section>
          <h2>Nos annonces de maison</h2>
          <div id="house-container">
             <?php
            foreach ($houses as $product) {
                include "createArticle.php";
            }
        ?>
          </div>
        </section>
        <section>
          <h2>Nos annonces d'appartement</h2>
          <div id="appartement-container">
          <?php
            foreach ($appartements as $product) {
                include "createArticle.php";
            }
        ?>
          </div>
        </section>
      </div>
      <footer>
        <p>© 2025 Find My Dream Home – Tous droits réservés.</p>
      </footer>
    </main>
  </body>
</html>
