<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../../admin_login.php");
    exit;
}
include('../../php/db_connect.php');

// Fetch the users item to edit
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_assoc();

    if (!$users) {
        header("Location: ../users.php?error=users item not found");
        exit;
    }
}

// Update the users item
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $is_admin = $_POST['is_admin'];

    $query = "UPDATE users SET name = ?, email = ?, password = ?,is_admin = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssii", $name, $email, $password, $is_admin, $id);

    if($stmt->execute()) {
        $_SESSION["success_message"] = "User Updated Successfully!";
    } else {
        $_SESSION["error_message"] = "User Faild to Update!";
    }
    header("Location: ../users.php");
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit USERS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit User</h2>

        <!-- Error/Success Messages -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>

        <form action="edit_user.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($users['id']); ?>">

            <div class="form-group">
                <label for="name">User Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($users['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($users['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="category">Password</label>
                <input type="text" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($users['password']); ?>" required>
            </div>

            <div class="form-group">
                <label for="image_url">Is Admin ?</label>
                <input type="text" class="form-control" id="is_admin" name="is_admin" value="<?php echo htmlspecialchars($users['is_admin']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Update USER</button>
            <a href="../users.php" class="btn btn-secondary btn-block">Cancel</a>
        </form>
    </div>
</body>
</html>
