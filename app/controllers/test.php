<?php 
    require "../controllers/DatabaseController.php";
    require("../models/ProductModel.php");
    require("../models/SessionModel.php");
    require("../models/CheckoutModel.php");
    require("../controllers/SessionController.php");
    require "../models/UserModel.php";
// require "../controllers/DatabaseController.php";
// require "../models/ProductModel.php";
    $user_data = [];
    var_dump(UserModel::getAllUsers());
?>