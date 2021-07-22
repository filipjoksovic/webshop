<?php 
    include_once("../controllers/SessionController.php");
    session_unset();
    header('location:../index.php');
?>