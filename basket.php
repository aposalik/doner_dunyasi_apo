<?php
session_start();
include('php/db_connect.php');

// Fetch basket items from the session
$basketItems = $_SESSION['basket'] ?? []; // Retrieve the basket from the session
$totalPrice = 0; // Initialize total price
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include('./header.php'); ?> <!-- Include header -->
    
    <div class="container mt-5">
        <h1 class="text-center">Sepetiniz</h1>

        <!-- Basket Items Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Yemek adı</th>
                    <th>Yemek</th>
                    <th>Ücret</th>
                    <th>Adet</th>
                    <th>Toplam</th>
                    <th>Eylemler</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($_SESSION['basket'])): ?>
                    <?php foreach ($_SESSION['basket'] as $item): 
        // Fetch food item details from the database
        $query = "SELECT * FROM Food WHERE id = " . $item['id'];
        $result = $conn->query($query);
        $food = $result->fetch_assoc();
        $itemTotal = $food['price'] * $item['quantity'];
        $totalPrice += $itemTotal;
    ?>
        <tr data-id="<?php echo $item['id']; ?>">
            <td><?php echo $food['name']; ?></td>
            <td><img src="<?php echo $food['image_url']; ?>" alt="<?php echo $food['name']; ?>" style="width: 50px; height: 50px;"></td>
            <td>₺<?php echo $food['price']; ?></td>
            <td>
                <input type="number" class="form-control qty-input" value="<?php echo $item['quantity']; ?>" min="1" data-id="<?php echo $item['id']; ?>" data-price="<?php echo $food['price']; ?>">
            </td>
            <td class="item-total">₺<?php echo number_format($itemTotal, 2); ?></td>
            <td>
                <button class="btn btn-danger btn-sm remove-btn">Sil</button>
            </td>
        </tr>
    <?php endforeach; ?>
        <?php else: ?>
    <tr>
        <td colspan="6" class="text-center">Sepetiniz boş!</td>
    </tr>
        <?php endif; ?>

            </tbody>
        </table>

        <!-- Total Price and Order Buttons -->
        <div class="text-right">
            <h4>Total: ₺<span id="total-price"><?php echo $totalPrice; ?></span></h4>
            <button id="order-all-btn" class="btn btn-success">Tümünü sipariş et</button>
        </div>
    </div>

    <!-- Popups for Address and Payment -->
    <div id="address-popup" class="popup">
        <div class="popup-content">
            <h2>Teslimat Adresini Girin</h2>
            <form id="address-form">
                <div class="form-group">
                    <label for="state">İl</label>
                    <input type="text" id="state" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">adres</label>
                    <input type="text" id="address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="apartment">Daire No</label>
                    <input type="text" id="apartment" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">Telefon Numarası</label>
                    <input type="tel" id="phone" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Sonraki</button>
            </form>
        </div>
    </div>

    <div id="payment-popup" class="popup">
        <div class="popup-content">
            <h2>Ödeme Bilgilerini Girin</h2>
            <form id="payment-form">
                <div class="form-group">
                    <label for="card-number">Kart Numarası</label>
                    <input type="text" id="card-number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="expiry">Son kullanma tarihi</label>
                    <input type="text" id="expiry" class="form-control" placeholder="MM/YY" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Sipariş Ver</button>
            </form>
        </div>
    </div>

    <script src="./assets/js/scripts.js"></script>
</body>
</html>