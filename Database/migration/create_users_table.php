<?php

include "../../Helpers/DBConnection.php";

$conn_obj = new DBConnection();
$conn = $conn_obj->connect();


$query = "CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30) NULL,
    last_name VARCHAR(30) NULL,
    email VARCHAR(30) NULL,
    phone VARCHAR(30) NULL,
    address VARCHAR(30) NULL,
    password VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
)";

try {
    $conn->query($query);
    echo "table created successfully";
}catch (PDOException $e){
    echo "table not created".$e->getMessage();
}