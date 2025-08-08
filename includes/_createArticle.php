


<article>
    <header>
        <img src="<?php echo $product['image_url'] ?>" alt="" />
        <p class="type">type:                              <?php echo $product['transaction_type'] ?></p>
    </header>
    <div class="title">
        <h3><?php echo $product['title'] ?></h3>
        <p class="price"><?php echo $product['price'] ?></p>
    </div>
    <p class="location"><?php echo $product['location'] ?></p>
    <p class="description">
        <?php echo $product['description'] ?>
    </p>

    <div id=button-container>
        <a href="updateFavoris.php?id=<?php echo $product['id'] ?>" class="link">Favori</a>
       <!-- <?php echo $isFavorited ? '❤️' : '🤍'; ?> -->
        <a href="delete.php?id=<?php echo $product['id'] ?>" class="link">Supprimer</a>
        <a href="update.php?id=<?php echo $product['id'] ?>" class="link">Modifier</a>
    </div>
    <button>Contact</button>

</article>