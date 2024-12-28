<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit;
}
include('../php/db_connect.php');

// Fetch all food items
$query = "SELECT * FROM Food";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Yemek Yönetimi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container mt-5">
        <h2 class="text-center">Yemekleri Yönet</h2>

        <!-- Add Food Form -->
        <div class="card p-4 mb-4">
            <h4>Yeni Yemek Menüsü Ekle</h4>
            <form action="./php/add_food.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <label for="name">Yemek Adı</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="price">Ücret</label>
                        <input type="number" name="price" id="price" class="form-control" step="0.01" required>
                    </div>
                    <div class="col-md-4">
                        <label for="category">Kategori</label>
                        <input type="text" name="category" id="category" class="form-control" required>
                    </div>
                    <div class="col-md-8 mt-3">
                        <label for="image_url">Foto URL</label>
                        <input type="text" name="image_url" id="image_url" class="form-control" required>
                    </div>
                    <div class="col-md-4 mt-3">
                        <button type="submit" class="btn btn-success w-100 mt-4">Yemek Ekle</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Food Items Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Yemek Adı</th>
                    <th>Ücret</th>
                    <th>Kategori</th>
                    <th>Resim</th>
                    <th>Eylemler</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($food = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $food['id']; ?></td>
                        <td><?php echo $food['name']; ?></td>
                        <td>₺<?php echo $food['price']; ?></td>
                        <td><?php echo $food['category']; ?></td>
                        <td><img src="<?php echo $food['image_url']; ?>" alt="Food Image" width="60"></td>
                        <td>
                            <!-- Edit Button -->
                            <form action="./php/edit_food.php" method="GET" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $food['id']; ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Düzenle</button>
                            </form>
                            <!-- Delete Button -->
                            <form action="./php/delete_food.php" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $food['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
