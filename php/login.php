<?php
include('db_connect.php');

// Process login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve the user based on email
    $query = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Directly compare the plain text password
        if ($password === $user['password']) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../main_page.php");
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>
