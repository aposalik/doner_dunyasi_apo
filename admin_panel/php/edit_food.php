<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../../admin_login.php");
    exit;
}
include('../../php/db_connect.php');

// Fetch the food item to edit
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Food WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $food = $result->fetch_assoc();

    if (!$food) {
        header("Location: ../food_management.php?error=Food item not found");
        exit;
    }
}

// Update the food item
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image_url = $_POST['image_url'];

    $query = "UPDATE Food SET name = ?, price = ?, category = ?, image_url = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdssi", $name, $price, $category, $image_url, $id);

    if ($stmt->execute()) {
        header("Location: ../food_management.php?success=Food item updated successfully");
        exit;
    } else {
        header("Location: ../food_management.php?error=Failed to update food item");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Food</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Food Item</h2>

        <!-- Error/Success Messages -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>

        <form action="edit_food.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($food['id']); ?>">

            <div class="form-group">
                <label for="name">Food Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($food['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($food['price']); ?>" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" name="category" value="<?php echo htmlspecialchars($food['category']); ?>" required>
            </div>

            <div class="form-group">
                <label for="image_url">Image URL</label>
                <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo htmlspecialchars($food['image_url']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Update Food</button>
            <a href="../food_management.php" class="btn btn-secondary btn-block">Cancel</a>
        </form>
    </div>
</body>
</html>
