<?php

session_start();

include "../Controller/CRUDController.php";

use Controller\CRUDController;

$email = $_POST['email'];
$password = md5($_POST['password']);

$query = "SELECT id, email, password FROM users WHERE email='$email'";

$crud = new CRUDController();
$data = $crud->show($query);
if ($data){
    if ($data->password == $password){
       $_SESSION['email'] = $email;
       header('location: ../index.php');
    }else {
        echo 'Email/password doesn\'t Match';
    }
}else {
    echo 'Email doesn\'t exist';
}