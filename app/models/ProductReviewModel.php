<?php 
    class ProductReviewModel{
        public $id;
        public $product_id;
        public $user_id;
        public $review;
        public $rate;

        public function __construct($review_data){
            if(isset($review_data['id'])){
                $this->id = $review_data['id'];
            }
        $this->product_id = $review_data['product_id'];
        $this->user_id = $review_data['user_id'];
        $this->review = $review_data['review'];
        $this->rate = $review_data['rate'];
        }
        public function save(){
            require "../controllers/DatabaseController.php";

            $query = "INSERT INTO product_reviews(product_id,user_id,rate,review) VALUES({$this->product_id},{$this->user_id},{$this->rate},'{$this->review}')";

            if($database->query($query) === TRUE){
                return $databse->insert_id;
            }
            else{
                return $database->error;
            }
        }
        public function update(){
            require "../controllers/DatabaseController.php";

            $query = "UPDATE product_reviews SET rate = $this->rate, review = '{$this->review}'";

            if($database->query($query) === TRUE){
                return 1;
            }
            else{
                return $database->error;
            }
        }
    }
?>