<?php 

class UserModel{
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $role;
    function __construct($user_data){
        $this->username = $user_data['username'];
        $this->first_name = $user_data['first_name'];
        $this->last_name = $user_data['last_name'];
        $this->email = $user_data['email'];
        $this->password = $user_data['password'];
        $this->role = $user_data['role'];
    }
    function save(){
        require "../controllers/DatabaseController.php";
        $query = "INSERT INTO users(username,first_name,last_name,email,password) VALUES('{$this->username}','{$this->first_name}','{$this->last_name}','{$this->email}','{$this->password}')";
        if($database->query($query) === TRUE){
            return $database->insert_id;
        }
        return -1;
    }
    static function doesExist($username)
    {
        include("../controllers/DatabaseController.php");
        $query = "SELECT * FROM users where username = '{$username}' LIMIT 1";
        $user = $database->query($query);
        if ($user->num_rows > 0)
            return true;
        return false;
    }

}


?>