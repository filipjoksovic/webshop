<?php 
    require "../controllers/DatabaseController.php";
    require("../models/ProductModel.php");
    require("../models/SessionModel.php");
    require("../models/CheckoutModel.php");
    require("../controllers/SessionController.php");

// require "../controllers/DatabaseController.php";
// require "../models/ProductModel.php";
    var_dump(CheckoutModel::deleteCheckouts('6106ce7709d9b'));

?>