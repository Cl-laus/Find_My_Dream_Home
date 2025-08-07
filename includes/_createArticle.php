<article>
     <header>
                <img src="<?= $product['image_url'] ?>" alt="" />
                <p class="type">type: <?= $product['type'] ?></p>
    </header>
    <div class="title">
                <h3><?= $product['title'] ?></h3>
                <p class="price"><?= $product['price'] ?></p>
    </div>
    <p class="location"><?= $product['location'] ?></p>
    <p class="description">
               <?= $product['description'] ?>
    </p>
    <button>Contact</button>
</article>