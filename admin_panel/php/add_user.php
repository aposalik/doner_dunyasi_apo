<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../admin_login.php");
    exit;
}
include('../../php/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $is_admin = $_POST['is_admin'];


    $query = "INSERT INTO users(name,email,password,is_admin) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi",$name,$email,$password,$is_admin);


    if($stmt->execute()){
        $_SESSION["success_message"] = "$name Added Successfully!";
    }else{
        $_SESSION["error_message"] = "$name is Faild to Add!";
    }
    header("Location: ../users.php");
    exit;
}
?>
