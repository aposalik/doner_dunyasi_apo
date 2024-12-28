<?php
include('db_connect.php');

// Process signup
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO Users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($query)) {
        header("Location: login.php?success=1");
    } else {
        echo "Error: " . $conn-> error;
    }
}
?>
