<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit;
}
include('../../php/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];


    //deleting the user from orders as well 
    $queryDeleteorder = "DELETE from Orders WHERE user_id = ?";
    $stmt = $conn->prepare($queryDeleteorder);
    $stmt->bind_param("i",$id);
    $stmt->execute();


    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);

    if($stmt){
        $stmt->bind_param("i", $id);
        if($stmt->execute()) {
            $_SESSION["success_message"] = "User deleted Successfully!";
        } else {
            $_SESSION["error_message"] = "User is not deleted!";
        }
        header("Location: ../users.php");
        $stmt->close();
    }
}

?>
