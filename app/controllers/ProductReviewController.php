<?php
    require "../controllers/SessionController.php";
    require "../models/ProductReviewModel.php";

    if(isset($_POST['leave_review'])){
        $review_data['product_id'] = $_POST['product_id'];
        $review_data['user_id'] = $_SESSION['user']['uid'];
        $review_data['rate'] = $_POST['rate'];
        $review_data['review'] = $_POST['review'];
        $productReviewModelInstance = new ProductReviewModel($review_data);
        $status = [];
        $save_data = $productReviewModelInstance->save();
        if($save_data > 0){
            setMessage("Uspesno ocenjen proizvod",200);
        }
        else{
            setMessage("Greska prilikom ocenjivanja proizvoda", 500);
        }
        header("location:../public/product_details.php?product_id{$review_data['product_id']}");
    }
?>