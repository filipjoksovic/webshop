<?php 
    include('./DatabaseController.php');
    include('./SessionController.php');
    include('../models/UserModel.php');
    if(isset($_POST['login'])){
        if($_POST['username'] == "" || $_POST['password'] == ""){
            setMessage('Molimo unesite sve podatke',500);
            header('location: ../public/login.php');
        }

        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $query = "SELECT * FROM users where (username = '{$username}' OR email = '{$username}') AND password = '{$password}' LIMIT 1";
        $user = $database->query($query);
        if($user->num_rows > 0){
            $user = $user->fetch_assoc();
            $_SESSION['user']['uid'] = $user['user_id'];
            $_SESSION['user']['username'] = $user['username'];
            $_SESSION['user']['role'] = $user['role'];
            if($user['role'] == 'buyer'){
                header("location: ../public/home.php");
            }
            if ($user['role'] == 'seller') {
                header("location: ../public/seller.php");
            }
            if ($user['role'] == 'admin') {
                header("location: ../public/admin.php");
            }
        }
        else{
            setMessage('Pogresna lozinka ili korisnicko ime. Promenite podatke i pokusajte ponovo',500);
            header("location: ../public/login.php");
        }
    }
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $role = $_POST['role'];
        $query = "INSERT INTO users(username,first_name,last_name,email,password,role) VALUES ('{$username}','{$first_name}','{$last_name}','{$email}','{$password}','{$role}')";
        if($database->query($query) === TRUE){
            $_SESSION['user']['uid'] = $database->insert_id;
            $_SESSION['user']['username'] = $username;
            $_SESSION['user']['role'] = $role;
            setMessage("Uspesna registracija! Dobro dosli!",200);
            if($role == 'buyer'){
                header('location: ../public/home.php');
            }
            if($role == 'seller'){
                header('location: ../public/seller.php');
            }
            if($role == 'admin'){
                header("location: ../public/admin.php");
            }
        }
    }
    if(isset($_GET['find_user'])){
        $user_id = $_GET['user_id'];
        $query = "SELECT * FROM users WHERE user_id = {$user_id}";
        $user = $database->query($query);
        if($user->num_rows == 0){
            $response['status']['status'] = 500;
            $response['status']['message'] = "Trazeni korisnik ne postoji u bazi podataka";
            $response['user']['uid'] = null;
            $response['user']['username'] = null;
            $response['user']['first_name'] = null;
            $response['user']['last_name'] = null;
            $response['user']['email'] = null;
        }
        else{
            $user = $user->fetch_assoc();
            $response['status']['status'] = 200;
            $response['status']['message'] = "Trazeni korisnik je pronadjen u bazi podataka";
            $response['user']['uid'] = $user['user_id'];
            $response['user']['username'] = $user['username'];
            $response['user']['first_name'] = $user['first_name'];
            $response['user']['last_name'] = $user['last_name'];
            $response['user']['email'] = $user['email'];
        }
       
        echo json_encode($response);
    }
    if(isset($_POST['edit_user'])){
        $response = [];
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $user_id = $_POST['user_id'];
        if($username == "" || $first_name == "" || $last_name == "" || $email == ""){
            $response['status']['status'] = 500;
            $response['status']['message'] = "Nisu popunjeni svi podaci. Popunite podatke i pokusajte ponovo";
            echo json_encode($response);
            return;
        }
        $userExists = doesExist($username);
        if($userExists){
            $response['status']['status'] = 500;
            $response['status']['message'] = "Korisnik sa ovim korisnickim imenom ili email adresom vec postoji";
            echo json_encode($response);
            return;
        }
        else{
            try{
                $query = "UPDATE users SET username = '{$username}', first_name = '{$first_name}', last_name = '{$last_name}', email = '{$email}' WHERE user_id = {$user_id}";
                $database->query($query);
                $response['status']['status'] = 200;
                $response['status']['message'] = "Korisnik je uspesno izmenjen";
                echo json_encode($response);
                return;
            }
            catch(Exception){
                echo $database->error;
                $response['status']['status'] = 500;
                $response['status']['message'] = $database->error;
                json_encode($response);
                return;
            }
        }
    }   
    if(isset($_POST['remove_user'])){
        $user_id = $_POST['user_id'];
        try{
            $query = "DELETE FROM users WHERE user_id = {$user_id}";
            $database->query($query);
            $response['status']['status'] = 200;
            $response['status']['message'] = "Korisnik je uspesno uklonjen iz baze podataka";
            echo json_encode($response);
        }
        catch(Exception){
            $response['status']['status'] = 500;
            $response['status']['message'] = $database->error;
            echo json_encode($response);
        }
    }
?>