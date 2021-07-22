<?php 
    require "../controllers/DatabaseController.php";
    require "../controllers/SessionController.php";
    require "../models/ProductModel.php";
    require "../models/ProductImageModel.php";

    if(isset($_POST['add_product'])){
        if($_SESSION['user']['role'] != 'seller'){
            setMessage("Nije vam dozvoljeno dodavanje proizvoda ukoliko niste prodavac",500);
            header("location:../public/home.php");
        }
        else{
            $product_data = [];
            $product_data['product_name'] = $_POST['product_name'];
            $product_data['owner_id'] = $_SESSION['user']['uid'];
            $product_data['category_id'] = $_POST['category'];
            $product_data['price'] = $_POST['price'];
            $product_data['quantity'] = $_POST['quantity'];
            $productModelInstance = new ProductModel($product_data);
        // $productModelInstance->validateData($product_data);
            // var_dump($_POST);

            var_dump($_FILES);
            return;
            // $productModelInstance->save($product_data);
            setMessage("Uspesno dodavanje proizvoda",200);
            header("location:../public/seller.php");
        }
    }

?>