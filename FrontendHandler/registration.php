<?php

include "../Controller/CRUDController.php";

use Controller\CRUDController;

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = md5($_POST['password']);

$query = "INSERT INTO users (first_name, last_name, email, phone, address, password) VALUES ('$first_name', '$last_name', '$email', '$phone', '$address', '$password')";

$crud = new CRUDController();
if ($crud->store($query)){
   header('location: ../login.php?msg=Registration Successfully Completed');
}

