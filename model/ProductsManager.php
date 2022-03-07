<?php

require_once('model/Manager.php');

class ProductsManager extends Manager {

    public function getProducts() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM products ORDER BY id DESC');
    
        return $req;
    }

    public function getProduct($id) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM products WHERE id = :product_id');
        $req->execute(array('product_id' => $id));

        return $req;
    }

    public function getProductsNumber() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM products');
        $count = $req->rowCount();

        return $count;
    }

    public function orderPlaced() {
        $productsInCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

        if($productsInCart) {

            $arrayToQuestionMarks = implode(',', array_fill(0, count($productsInCart), '?'));

            $db = $this->dbConnect();

            $req = $db->prepare('SELECT * FROM products WHERE id IN (' . $arrayToQuestionMarks . ')');
            $req->execute(array_keys($productsInCart));
            $products = $req->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($products as $p) {
                //echo 'id :'.$p['id'].' quantity :'.$p['product_quantity'];
            
                foreach($_SESSION['cart'] as $id => $quantity) {
                    
                    if($p['id'] == $id) {
                        $result = $p['product_quantity'] - $quantity;
                        $req = $db->prepare("UPDATE products SET product_quantity='$result' WHERE id='$id'");
                        $req->execute();
                    }
                }
            }
            unset($_SESSION['cart']);
        }
    }

}
