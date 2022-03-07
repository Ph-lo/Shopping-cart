<?php $title = 'Shopping Cart';


ob_start(); ?>
        
<body>
<div class="product_border"></div>
<?php 
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

?>
<form id="cart" action="index.php?/=updateCart" method="POST">
    <div class="cart">
        <table>
            <thead>
                <tr>
                    <th id="table_product" colspan="2">Products</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($p as $product): ?>
                <tr>
                    <td class="product_td"><a href="index.php?/=product&idp=<?= $product['id'] ?>"><img src="public/products_images/<?= $product['product_image'] ?>" alt="product image" /></a></td>
                    <td id="name_td" class="product_td">
                        <a href="index.php?/=product&idp=<?= $product['id'] ?>"><?= htmlspecialchars(ucfirst($product['product_name'])) ?></a><br />
                        <a class="remove_link" href="index.php?/=remove&id=<?= $product['id'] ?>">remove item</a>
                    </td>
                    <td>&dollar;<?= htmlspecialchars($product['product_price']) ?></td>
                    <td>
                        <input type="number" name="quantity-<?= $product['id'] ?>" value="<?= $productsInCart[$product['id']] ?>" min="1" max="<?= $product['product_quantity'] ?>" required />
                    </td>
                    <td>&dollar;<?= $productsInCart[$product['id']] * $product['product_price'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div> 

        <div id="subtotal">
            <p>
                subtotal : 
                <?php 
                $subtotal = 0.00;
                foreach($p as $product) {
                    $subtotal += $product['product_price'] * $productsInCart[$product['id']];
                }
                echo '&dollar;'.$subtotal;
                ?>
            </p>
            <input type="submit" value="update" name="update"/>
            <input type="submit" value="order" name="order"/>
        </div>
        <?php 

} else {
    echo '<p id="empty_cart">Your shopping cart is empty.</p>';
}
    ?>
</form>

</body>
<?php $content = ob_get_clean(); 


require('view/template.php'); ?>