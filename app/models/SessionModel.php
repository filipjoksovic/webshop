<?php 
    class SessionModel{
        static function addToCart($product_id)
        {
            try{
                array_push($_SESSION['cart'], $product_id);
                return 1;
            }
            catch(Exception $e){
                return -1;
            }
        }
        static function removeFromCart($product_id)
        {
            try{
                $item_index = array_search($product_id, $_SESSION['cart']);
                unset($_SESSION['cart'][$item_index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                return 1;
            }
            catch(Exception $e){
                return -1;
            }
        }
    }
?>