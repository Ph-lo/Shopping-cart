<?php $title = 'Shop products';


ob_start(); ?>
        
<body>
    <div class="product_border"></div>
    <div class="order_placed">
        <h3>Thanks you for shopping with us !</h3>
  
        <p>Your order has been placed.</p>
    </div>
    
</body>

<?php
$content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>