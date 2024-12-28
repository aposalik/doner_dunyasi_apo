<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit;
}
include('../php/db_connect.php');

// Fetch all food items
$query = "SELECT * FROM users";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kullanıcı Yönetimi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('header.php'); ?>
    <?php
        if(isset($_SESSION["success_message"])){
            echo '<div class="alert alert-success text-center">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
            unset($_SESSION['success_message']);
        };
        if(isset($_SESSION["error_message"])){
            echo '<div class="alert alert-danger text-center">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
            unset($_SESSION['error_message']); 
        };
    ?>
    <div class="container mt-5">
        <h2 class="text-center">Kullanıcı Yönetimi</h2>

        <!-- Add User Form -->
        <div class="card p-4 mb-4">
            <h4>Yeni KULLANICILAR Ekle</h4>
            <form action="./php/add_user.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <label for="price">Ad</label>
                        <input type="text" name="name" id="name" class="form-control" step="0.01" required>
                    </div>
                    <div class="col-md-4">
                        <label for="category">Email</label>
                        <input type="text" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="col-md-8 mt-3">
                        <label for="image_url">Password</label>
                        <input type="text" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="col-md-8 mt-3">
                        <label for="image_url">Is_admin</label>
                        <input type="text" name="is_admin" id="is_admin" class="form-control" required>
                    </div>
                    <div class="col-md-4 mt-3">
                        <button type="submit" class="btn btn-success w-100 mt-4">Kullanıcı Ekle</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- User Items Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Is Admin </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($users = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $users['id']; ?></td>
                        <td><?php echo $users['name']; ?></td>
                        <td><?php echo $users['email']; ?></td>
                        <td><?php echo $users['password']; ?></td>
                        <td><?php echo $users['is_admin']; ?></td>                        <td>
                            <!-- Edit Button -->
                            <form action="./php/edit_user.php" method="GET" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $users['id']; ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                            </form>
                            <!-- Delete Button -->
                            <form action="./php/delete_user.php" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $users['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
