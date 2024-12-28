<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit;
}
include('../../php/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];


    //deleting the food from orders as well 
    $queryDeleteorder = "DELETE from Orders WHERE food_id = ?";
    $stmt = $conn->prepare($queryDeleteorder);
    $stmt->bind_param("i",$id);
    $stmt->execute();


    $query = "DELETE FROM Food WHERE id = ?";
    $stmt = $conn->prepare($query);

    if($stmt){
        $stmt->bind_param("i", $id);
        if($stmt->execute()) {
            header("Location: delete_food.php?success=Food item deleted successfully");
        } else {
            header("Location: delete_food.php?error=Failed to delete food item");
        }
        $stmt->close();
    }
}

?>
