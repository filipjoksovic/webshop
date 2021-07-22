<?php
    require './DatabaseController.php';

    if(isset($_GET['get_categories'])){
        try{
            $query = "SELECT * FROM categories";
            $categories = $database->query($query);
            $cat_arr = [];
            if($categories->num_rows != 0){
                $i = 0;
                while($category = $categories->fetch_assoc()){
                    $cat_arr[$i]['id'] = $category['id'];
                    $cat_arr[$i]['category_name'] = $category['category_name'];
                    $i++;
                }
                $status['status'] = 200;
                $status['message'] = "All ok";
                $status['response'] = $cat_arr;
                echo json_encode($status);
            }
        }
        catch(Exception $e){
            $status['status'] = 500;
            $status['message'] = "Greska prilikom prikupljanja kategorija";
        }
    }

?>