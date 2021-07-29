<?php 
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    // var_dump($_SESSION);
    function setMessage($message,$status){
        $_SESSION['message']['text'] = $message;
        $_SESSION['message']['status'] = $status;
    }
    function addToCart($product_id){
        array_push($_SESSION['cart'],$product_id);
    }
    function removeFromCart($product_id){
        $item_index = array_search($product_id,$_SESSION['cart']);
        unset($_SESSION['cart'][$item_index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
?>