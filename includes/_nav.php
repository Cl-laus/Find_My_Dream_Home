<?php
    // Récupérer le nom du fichier actuel. $_SERVER['PHP_SELF'] recupere le chemin actuel et basename le nom
    $current_page = basename($_SERVER['PHP_SELF']);
?>

<nav>
        <h1><a href="index.php">Find My Dream Home</a></h1>
        <div id="links"
                       <?php
                       // cache le menu (en ajoutant le style)si on est pas sur la page index
                       if ($current_page !== 'index.php'): ?> style="display:none"
                       <?php endif;
                       ?>>
          <div class="link"><a href="#house-container">House</a></div>
          <div class="link"><a href="#appartement-container">Appartement</a></div>
          <div class="link"><a href="add.php">Add</a></div>
          <div class="link"><a href="login.php">Login</a></div>
          <div class="link">Logout</div>
        </div>
</nav>
