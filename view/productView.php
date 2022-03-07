<?php $title = 'Product';

$data = $product->fetch();

ob_start(); ?>
        
<body>
    <div class="product_border"></div>
    <div class="product">
        
            
        <a href="index.php?/=product&idp=<?= $data['id'] ?>"><img src="public/products_images/<?= $data['product_image'] ?>" alt="product image" /></a>
        
        <div class="price_and_options">
            <p class="product_name">
                <?= htmlspecialchars(ucfirst($data['product_name'])) ?>
            </p>
            <h2>$<?= $data['product_price'] ?></h2>
            <form action="index.php?/=addToCart" method="POST">
                <input name="id" type="hidden" value="<?= $data['id'] ?>" />
                <select name="quantity">
                    <?php
                    for($option = 1; $option <= $data['product_quantity']; $option++) {
                        echo '<option>'.$option.'</option>';
                    }
                    ?>
                </select><br />
                <input type="submit" value="Add to cart"/>
            </form>
            <div class="product_info">
                <p><?= $data['product_infos'] ?></p>
            </div>
        </div>
        
    </div>

    

    <?php $product->closeCursor(); ?>

</body>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>