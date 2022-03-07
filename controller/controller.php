<?php

require_once('model/ProductsManager.php');
require_once('model/CartManager.php');


$result = new ProductsManager;
$products_number = $result->getProductsNumber();


function listProducts() {
    $productsManager = new ProductsManager; // Create an object of the class
    $products = $productsManager->getProducts(); // Call a function of this object

    require('view/listProductsView.php');
}

function getProduct($id) {
    $productsManager = new ProductsManager;
    $product = $productsManager->getProduct($id);

    require('view/productView.php');
}

function shoppingCart() {
    $products = new CartManager;
    $p = $products->getCart();
    $productsInCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    require('view/shoppingCartView.php');
}

function addToCart($id, $quantity) {
    $add = new CartManager;
    $added_product = $add->addProductToCart($id, $quantity);

    if($added_product === false) {
        throw new Exception('Couldn\'t add to cart');

    } else {
        
        header('Location: index.php?/=cart');
    }
}

function updateCart($post) {
    $update = new CartManager;
    $update->updateCartQuantity($post);

    header('Location: index.php?/=cart');
}

function deleteItemFromCart($id) {
    $delete = new CartManager;
    $delete->deleteFromCart($id);

    header('Location: index.php?/=cart');
}

function order() {

    $order_quantity_update = new ProductsManager;
    $order_quantity_update->orderPlaced();
    header('Location: index.php?/=orderPlaced');
}

function orderPlacedHeader() {
    require('view/orderPlacedView.php');
}