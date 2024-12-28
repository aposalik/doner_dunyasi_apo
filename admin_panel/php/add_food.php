<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../admin_login.php");
    exit;
}
include('../../php/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image_url = $_POST['image_url'];

    $query = "INSERT INTO Food(name,price,category,image_url) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdss",$name,$price,$category,$image_url);

    if ($stmt->execute()) {
        header("Location: add_food.php?success=Food item added successfully");
        exit;
    } else {
        header("Location: add_food.php?error=Failed to add food item");
        exit;
    }
}
?>
