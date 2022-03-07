<?php

require_once('model/Manager.php');

class CartManager extends Manager {

    public function addProductToCart($id, $quantity) {

        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM products WHERE id = :id');
        $req->execute(array('id' => $id));
        $req_quantity = $req->fetch();
        $product_quantity = $req_quantity['product_quantity'];
        $product_exists = $req->rowCount();
        $req->closeCursor();

        if($product_exists !== 0) {
            if(isset($_SESSION['cart'])) {
                if(array_key_exists($id, $_SESSION['cart'])) {
                    if(($_SESSION['cart'][$id] + $quantity) <= $product_quantity) {
                        $_SESSION['cart'][$id] += $quantity;
                    } else {
                        throw new Exception('Couldn\'t add to cart, not enough items in stock');
                    }
                } else {
                    $_SESSION['cart'][$id] = $quantity;
                }
            } else {
                $_SESSION['cart'] = array($id => $quantity);
            }
        } else {
            throw new Exception('Couldn\'t add to cart, item not in stock.');
        }
    }

    public function getCart() {

        $productsInCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array(); // "?" is a ternary operator, it's a shorthand for the if{}else{} structure
        $products1 = array();

        if($productsInCart) {

            $arrayToQuestionMarks = implode(',', array_fill(0, count($productsInCart), '?'));

            $db = $this->dbConnect();
            $req = $db->prepare('SELECT * FROM products WHERE id IN (' . $arrayToQuestionMarks . ')');
            $req->execute(array_keys($productsInCart));
            $products = $req->fetchAll(PDO::FETCH_ASSOC);

            return $products;
        }
    }

    public function updateCartQuantity($post) {

        foreach($post as $key => $value) {
            if(strpos($key, 'quantity') !== false) {
                $id = str_replace('quantity-', '', $key);
                $quantity = $value;

                if(isset($_SESSION['cart'][$id]) && $quantity > 0) {
                    $_SESSION['cart'][$id] = $quantity;
                }
            }
        }
    }

    public function deleteFromCart($id) {
        unset($_SESSION['cart'][$id]);
    }
}
