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
            $product_data['stock'] = $_POST['stock'];
            $productModelInstance = new ProductModel($product_data);
            $productModelInstance->validateData($product_data);
            // var_dump($_POST);
            $productModelInstance->save();
            if($productModelInstance->id == -1){
                // setMessage("Doslo je do greske prilikom dodavanja proizvoda u bazu.",500);
                header("location: ../public/seller.php");
                return;
            }
            $fileCount = count($_FILES['product_images']['name']);
            for($i = 0; $i < $fileCount; $i++){
                $product_image_data['product_id'] = $productModelInstance->id;
                $product_image_data['temp_path'] = $_FILES['product_images']['tmp_name'][$i];
                $product_image_data['path'] = "../resources/product_images/". $_FILES['product_images']['name'][$i];
                $productImageModelInstance = new ProductImageModel($product_image_data);
                // $productImageModelInstance->validateData();
                $result = $productImageModelInstance->save();
                if($result != 1){
                    setMessage("Doslo je do greske prilikom dodavanja fotografija proizvoda u bazu podataka.",500);
                    header( "location:../public/seller.php");
                    return;
                }                
            }
            setMessage("Uspesno dodavanje proizvoda",200);
            header("location:../public/seller.php");
        }
    }

?>