<?php 

function doesExist($username){
    include("../controllers/DatabaseController.php");
    $query = "SELECT * FROM users where username = '{$username}' LIMIT 1";
    $user = $database->query($query);
    if($user->num_rows > 0) 
        return true;
    return false;
}

?>