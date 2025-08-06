<article>
     <header>
                <img src="<?= $product['image'] ?>" alt="" />
                <p class="type">type: <?= $product['type'] ?></p>
    </header>
    <div class="title">
                <h3><?= $product['title'] ?></h3>
                <p class="price"><?= $product['price'] ?></p>
    </div>
    <p class="localisation"><?= $product['localisation'] ?></p>
    <p class="description">
               <?= $product['description'] ?>
    </p>
    <button>Contact</button>
</article>