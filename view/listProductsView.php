<?php $title = 'Shop products';


ob_start(); ?>
        
<body>
    <div id="banner">
        <p>The ultimate essentials for the 21/22 winter trends</p>
    </div>
    <div id="products">
    <?php
    while ($data = $products->fetch())
    {
    ?>
        <div class="products">
            <a href="index.php?/=product&idp=<?= $data['id'] ?>">
        
                <img src="public/products_images/<?= $data['product_image'] ?>" alt="product image" />
                <h3>
                    <?= htmlspecialchars($data['product_name']) ?>
                </h3>
            </a>
            <p>&dollar; <?= $data['product_price'] ?></p>
        </div>
    <?php
    }
    $products->closeCursor();
    ?>
    </div>
</body>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>