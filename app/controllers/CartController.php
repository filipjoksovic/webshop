<?php
    require "../controllers/SessionController.php";
    require "../models/SessionModel.php";

    
    if(isset($_POST['add_to_cart'])){
        $status = [];
        try{        
            $product_id = $_POST['product_id'];
            SessionModel::addToCart($product_id);
            $status['status'] = "200";
            $status['message'] = "Proizvod uspesno dodat u korpu";
            $status['response'] = count($_SESSION['cart']);
        }
        catch(Exception $e){
            $status['status'] = "500";
            $status['message'] = "Greska prilikom dodavanja proizvoda u korpu";
            $status['response'] = count($_SESSION['cart']);
        }
        finally{
            echo json_encode($status);
        }
    }
?>