<?php
    // Récupérer le nom du fichier actuel. $_SERVER['PHP_SELF'] recupere le chemin actuel et basename le nom
    $current_page = basename($_SERVER['PHP_SELF']);
?>
<nav>

    <h1><a href="index.php">Find My Dream Home</a></h1>
    <div id="links" <?php if ($current_page !== 'index.php'): ?> style="display:none" <?php endif;
?>>
        <div class="link"><a href="#house-container">House</a></div>
        <div class="link"><a href="#appartement-container">Appartement</a></div>

        <?php
            if (! isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
                echo '<div class="link"><a href="login.php">Login</a></div>';
            } else {
                echo '<div class="link"><a href="add.php">Add</a></div>';
                echo '<div class="link"><a href="favoris.php">Mes Favoris</a></div>';
                echo '<div id="logout"><a href="logout.php">Logout</a></div>';
            }
        ?>

    </div>
</nav>