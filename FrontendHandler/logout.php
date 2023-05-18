<?php
session_start();
if (isset($_POST['logout'])) {
    unset($_SESSION['email']);
    header('location: ../login.php');
}

