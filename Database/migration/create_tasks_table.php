<?php

include "../../Helpers/DBConnection.php";

$conn_obj = new DBConnection();
$conn = $conn_obj->connect();


$query = "CREATE TABLE tasks (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NULL,
    description TEXT NULL,
    status INT(1) NULL,
    user_id INT(11) NULL,
    deadline TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
)";

try {
    $conn->query($query);
    echo "table created successfully";
}catch (PDOException $e){
    echo "table not created".$e->getMessage();
}
