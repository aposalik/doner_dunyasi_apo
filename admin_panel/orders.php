<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: ./admin_login.php");
    exit;
}
include('../php/db_connect.php');

// Handle status update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $orderId = intval($_POST['order_id']); 
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Build the query dynamically
    $query = "UPDATE Orders SET status = '$status' WHERE id = $orderId";

    // Execute the query
    if ($conn->query($query)) {
        $successMessage = "Sipariş durumu başarıyla güncellendi!";
    } else {
        $errorMessage = "Sipariş durumu güncellenemedi: " . $conn->error;
    }
}

// Fetch all orders
$query = "SELECT Orders.id, Users.name AS customer, Food.name AS food, Orders.order_date, Orders.status
          FROM Orders
          JOIN Users ON Orders.user_id = Users.id
          JOIN Food ON Orders.food_id = Food.id";
$result = $conn->query($query);
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <title>Siparişler</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container mt-5">
        <h2 class="text-center">Siparişleri Yönet</h2>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Sipariş ID</th>
                    <th>Müşteri</th>
                    <th>Yemek adı</th>
                    <th>Sipariş Tarihi</th>
                    <th>Durum</th>
                    <th>Eylemler</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['customer']; ?></td>
                        <td><?php echo $order['food']; ?></td>
                        <td><?php echo $order['order_date']; ?></td>
                        <td><?php echo $order['status']; ?></td>
                        <td>
                            <form action="orders.php" method="POST" style="display: inline;">
                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                <select name="status" class="form-control">
                                    <option value="Pending" <?php echo $order['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Accepted" <?php echo $order['status'] == 'Accepted' ? 'selected' : ''; ?>>Accepted</option>
                                    <option value="Completed" <?php echo $order['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm mt-1">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
