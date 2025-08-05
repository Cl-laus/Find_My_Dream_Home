  <?php
// Récupérer le nom du fichier actuel. $_SERVER['PHP_SELF'] recupere le chemin actuel et basename le nom
        $current_page = basename($_SERVER['PHP_SELF']);
   ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agence Immobiliere</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nata+Sans:wght@100..900&display=swap" rel="stylesheet">
  </head>
  <body>
    <main>
      <nav>
        <h1><a href="index.php">Find My Dream Home</a></h1>
        <div id="links"
                       <?php 
                       // cache le menu (en ajoutant le style)si on est pas sur la page index
                       if ($current_page !== 'index.php') : ?> style="display:none"
                       <?php endif;
                        ?>>
          <div class="link"><a href="#house-container">House</a></div>
          <div class="link"><a href="#appartement-container">Appartement</a></div>
          <div class="link"><a href="login.php">Login</a></div>
        </div>
      </nav>
