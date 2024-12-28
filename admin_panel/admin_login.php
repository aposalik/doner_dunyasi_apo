<?php
session_start();
include('../php/db_connect.php');

// Handle admin login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if user is an admin
    $query = "SELECT * FROM Users WHERE email = ? AND is_admin = 1";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
        die("Query execution failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (trim($password) === trim($admin['password'])) {
            $_SESSION['user_id'] = $admin['id'];
            $_SESSION['is_admin'] = $admin['is_admin'];
            header("Location: dashboard.php"); // Redirect to admin dashboard
            exit;
        } else {
            $error = "Invalid password!";
        }        
    } else {
        $error = "No admin account found with this email.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg" style="width: 22rem;">
            <h2 class="text-center mb-4 text-danger">Yönetici Girişi</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger text-center"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-danger btn-block hover-effect">Giriş yap</button>
            </form>
        </div>
    </div>
</body>
</html>
