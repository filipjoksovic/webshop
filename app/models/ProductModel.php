<?php 
    class ProductModel{
        public $id;
        public $product_name;
        public $description;
        public $category_id;
        public $price;
        public $stock;
        public $owner_id;
        public $images;
        public $category_title;

        function __construct($product_data){
            if(isset($product_data['id'])){
                $this->id = $product_data['id'];
            }
            $this->product_name = $product_data['product_name'];
            if(isset($product_data['description'])){
            $this->description = $product_data['description'];
            }
            $this->category_id = $product_data['category_id'];
            $this->price = $product_data['price'];
            $this->stock = $product_data['stock'];
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
            if (!isset($product_data['stock']) || $product_data['stock'] == null || $product_data['stock'] == "") {
                setMessage("Molimo navedite stanje proizvoda", 500);
                header("location:../public/seller.php");
                return;
            }
        }
        function save(){
            require "../controllers/DatabaseController.php";
            require_once "../controllers/SessionController.php";
            $query = "INSERT INTO products(product_name,owner_id,category_id,price,stock) 
                      VALUES ('{$this->product_name}',{$this->owner_id},{$this->category_id},{$this->price},{$this->stock})";
            if($database->query($query) === TRUE){
                setMessage("Uspesno dodat proizvod u bazu podataka",200);
                $this->id =  $database->insert_id;
            }
            else{
                $this->id = -1;
                setMessage($database->error,500);
            }
            // header("location: ../public/seller.php");
        }
        static function getAllProducts(){
            require "../controllers/DatabaseController.php";
            require "../models/ProductImageModel.php";

            $query = "SELECT * FROM products";

            $products = [];

            $results = $database->query($query);
            while($row = $results->fetch_assoc()){
                $product = new ProductModel($row);
                $product->main_image = ProductImageModel::getMainImage($product->id);
                array_push($products,$product);
            }
            return $products;
        }
        static function deleteProduct($product_id){
            require "../controllers/DatabaseController.php";

            $query = "DELETE * from products WHERE id = {$product_id}";

            if($database->query($query) === TRUE){
                return 1;
            }
            else{
                return -1;
            }
        }
    }
?>