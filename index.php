<?php
session_start();

require('controller/controller.php');

try {

    if(isset($_GET['/'])) {

        if($_GET['/'] == 'listProducts')
        {
            listProducts();

        } elseif($_GET['/'] == 'cart')
        {
            shoppingCart();

        } elseif($_GET['/'] == 'product')
        {
            if(isset($_GET['idp']) && $_GET['idp'] >0 && $_GET['idp'] <= $products_number) {
                getProduct($_GET['idp']);
            } else {
                throw new Exception('No product found');
            }
        } elseif($_GET['/'] == 'addToCart') {
            
            if(isset($_POST['id']) && isset($_POST['quantity'])) {
                if(!empty($_POST['id']) && !empty($_POST['quantity'])) {
                    addToCart($_POST['id'], $_POST['quantity']);
                }
            }
            
        } elseif($_GET['/'] == 'updateCart') {

            if(isset($_POST) && isset($_SESSION['cart'])) {
                if(isset($_POST['update'])) {
                    updateCart($_POST);
                } elseif(isset($_POST['order'])) {
                    order();
                }
            }
        } elseif($_GET['/'] == 'remove') {

            if(isset($_GET['id']) && isset($_SESSION['cart'])) {
                if(isset($_GET['id']) && $_GET['id'] > 0) {
                    deleteItemFromCart($_GET['id']);
                }
            }
        }elseif($_GET['/'] == 'orderPlaced') {
            orderPlacedHeader();
        }
    } else {
        
        listProducts();
    }

} catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}