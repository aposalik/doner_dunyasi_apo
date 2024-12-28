<?php
include('../php/db_connect.php');

// Query for stats
$totalOrders = $conn->query("SELECT COUNT(*) AS count FROM Orders")->fetch_assoc()['count'];
$pendingOrders = $conn->query("SELECT COUNT(*) AS count FROM Orders WHERE status = 'Pending'")->fetch_assoc()['count'];
$totalFoodItems = $conn->query("SELECT COUNT(*) AS count FROM Food")->fetch_assoc()['count'];
$totalUsers = $conn->query("SELECT COUNT(*) AS count FROM Users")->fetch_assoc()['count'];

?>

<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: ./admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici Paneli</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<body>
    <?php include('header.php'); ?>
    <div class="container-fluid ">
        <div class="row">
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1 class="text-center mt-4">Yönetici Paneline</h1>
    <div class="row text-center mt-5">
        <!-- Orders Box -->
        <div class="col-md-4">
            <a href="orders.php" class="card card-link shadow-sm admin-box">
                <div class="card-body">
                    <i class="fas fa-shopping-cart mb-3 admin-icon"></i>
                    <h5>Siparişler</h5>
                </div>
            </a>
        </div>
        <!-- Food Management Box -->
        <div class="col-md-4">
            <a href="food_management.php" class="card card-link shadow-sm admin-box">
                <div class="card-body">
                    <i class="fas fa-utensils mb-3 admin-icon"></i>
                    <h5>Yemek Yönetimi</h5>
                </div>
            </a>
        </div>
        <!-- User Management Box -->
        <div class="col-md-4">
            <a href="users.php" class="card card-link shadow-sm admin-box">
                <div class="card-body">
                    <i class="fas fa-users mb-3 admin-icon"></i>
                    <h5>Kullanıcı Yönetimi</h5>
                </div>
            </a>
        </div>
    </div>
</main>




        </div>
    </div>
</body>
</html>