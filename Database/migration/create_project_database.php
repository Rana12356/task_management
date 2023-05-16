<?php

$server_name = 'localhost';
$user_name = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$server_name", $user_name, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "CREATE DATABASE task_management";
    if ($conn->query($query)){
        echo "Database created successfully";
    }
}catch (PDOException $e){
    echo "Database not created".$e->getMessage();
}
