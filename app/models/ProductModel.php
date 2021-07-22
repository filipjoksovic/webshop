<?php 
    class ProductModel{
        public $product_name;
        public $category_id;
        public $price;
        public $quantity;
        public $owner_id;

        function __construct($product_data){
            $this->product_name = $product_data['product_name'];
            $this->category_id = $product_data['category_id'];
            $this->price = $product_data['price'];
            $this->quantity = $product_data['quantity'];
            $this->owner_id = $product_data['owner_id'];
        }
        function validateData($product_data){
            if(!isset($product_data['product_name']) || $product_data['product_name'] == null || $product_data['product_name'] == ""){
                setMessage("Naziv proizvoda ne sme biti prazan",500);
                header("location:../public/seller.php");
                return;
            }
            if (!isset($product_data['category_id']) || $product_data['category_id'] == null || $product_data['category_id'] == "") {
                setMessage("Molimo odaberite kategoriju proizvoda", 500);
                header("location:../public/seller.php");
                return;
            }
            if (!isset($product_data['price']) || $product_data['price'] == null || $product_data['price'] == "") {
                setMessage("Molimo navedite cenu proizvoda", 500);
                header("location:../public/seller.php");
                return;
            }
            if (!isset($product_data['quantity']) || $product_data['quantity'] == null || $product_data['quantity'] == "") {
                setMessage("Molimo navedite stanje proizvoda", 500);
                header("location:../public/seller.php");
                return;
            }
        }
        function save(){
            require "../controllers/DatabaseController.php";
            require "../controllers/SessionController";
            $query = "INSERT INTO products(product_name,owner_id,category_id,price,quantity) 
                      VALUES ('{$this->product_name}',{$this->owner_id},{$category_id},{$price},{$quantity})";
            if($database->query($query) === TRUE){
                setMessage("Uspesno dodat proizvod u bazu podataka",200);
            }
            else{
                setMessage($database->error,500);
            }
            header("location: ../public/seller.php");
        }
    }
?>