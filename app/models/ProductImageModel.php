<?php
class ProductImageModel{
    public $id;
    public $product_id;
    public $path;

    function __construct($image_data){
        $this->product_id = $image_data['product_id'];
        $this->path = $image_data['path'];
    }
    function validateData($image_data){
        require "../controllers/SessionController.php";
        if(!isset($image_data['product_id']) || $image_data['product_id'] == ""){
            setMessage("Doslo je do greske prilikom validacije slike", 500);            
            header("location: ../public/seller.php");
            return;
        }
        if (!isset($image_data['path']) || $image_data['path'] == "") {
            setMessage("Doslo je do greske prilikom validacije putanje slike proizvoda", 500);
            header("location: ../public/seller.php");
            return;
        }
    }
    function save($image_data){
        require "../controllers/DatabaseController.php";
        require "../controllers/SessionController.php";

        $query = "INSERT INTO product_images(product_id,path) VALUES({$image_data['product_id']},{$image_data['path']})";
        if($database->query($query) === TRUE){
            setMessage("Uspesno dodavanje slike proizvoda",200);
        }
        else{
            setMessage("Doslo je do greske prilikom cuvanja slike proizvoda",500);
        }
        header("location: ../public/seller.php");
    }
}

?>