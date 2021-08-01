<?php 
    class ShippingProfileModel{
        public $user_id;
        public $first_name;
        public $last_name;
        public $address;
        public $city;
        public $zip_code;
        public $country;

        public function __construct($profile_data)
        {   
            $this->user_id = $profile_data['user_id'];
            $this->first_name = $profile_data['first_name'];
            $this->last_name = $profile_data['last_name'];
            $this->address = $profile_data['address'];
            $this->city = $profile_data['city'];
            $this->zip_code = $profile_data['zip_code'];
            $this->country = $profile_data['country'];
        }
        public function save(){
            require "../controllers/DatabaseController.php";

            $query = "INSERT INTO shipping_profiles(user_id,first_name,last_name,address,city,zip_code,country) VALUES({$this->user_id},'{$this->first_name}','{$this->last_name}','{$this->address}','{$this->city}','{$this->zip_code}','{$this->country}')";

            if($database->query($query) === TRUE){
                return $database->insert_id;
            }
            return -1;
        }
        public function update(){
            require "../controllers/DatabaseController.php";

            $query = "UPDATE shipping_profiles SET first_name = '{$this->first_name}',last_name = '{$this->last_name}',address = '{$this->address}',city = '{$this->city}',zip_code = '{$this->zip_code}',country = '{$this->country}' WHERE user_id = {$this->user_id}";
            
            if($database->query($query) === TRUE){
                return $this->user_id;
            }
            else{
                return $database->error;
            }
        }
        public static function getShippingProfile($user_id){
            require "../controllers/DatabaseController.php";
            // require "../models/UserModel.php";
            $query = "SELECT * from shipping_profiles WHERE user_id = {$user_id} LIMIT 1";
            $result = $database->query($query)->fetch_assoc();
            $profile = new ShippingProfileModel($result);
            return $profile;
        }
        public static function exists($user_id){
            require "../controllers/DatabaseController.php";

            $query = "SELECT * from shipping_profiles WHERE user_id = {$user_id} LIMIT 1";
            $result = $database->query($query);
            if($result->num_rows > 0){
                return true;
            }
            return false;
        }
    }
?>