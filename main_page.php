<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    <!-- Header Section -->
<header class="sticky-header bg-light shadow-sm">
    <div class="container d-flex align-items-center justify-content-between py-3">
        <!-- Logo -->
        <div class="logo">
            <h2 class="text-success">Döner Dünyası</h2>
        </div>

        <!-- Navigation Menu -->
        <nav class="nav">
          <a href="main_page.php" class="nav-link"><i class="fas fa-home"></i> Ana Sayfa</a>
          <a href="about_us.php" class="nav-link"><i class="fas fa-info-circle"></i> Hakkımızda</a>
          <a href="contact_us.php" class="nav-link"><i class="fas fa-phone"></i> İletişim</a>
          <a href="basket.php" class="nav-link basket-btn position-relative">
          <i class="fas fa-shopping-cart"></i> Sepet
            <span class="badge basket-count position-absolute top-0 start-100 translate-middle">0</span>
          </a>
        </nav>

    </div>
</header>

</head>
<body>
    <!-- Hero Section -->
    <section class="hero bg-light text-dark py-5">
        <div class="container d-flex align-items-center justify-content-between">
            <div>
                <h1 class="display-4">Lezzetin Keyfine Varın <br> <span class="text-success font-weight:bold ">Dönerle</span> Taçlandırın</h1>
                <p class="lead">Her Tabakta Aşçılık Ustalığı ve Tutkuyla Dokunan Bir Döner Hikayesi</p>
                <a href="./basket.php" class="btn btn-success btn-lg mr-3">Şimdi Sipariş Verin</a>
            </div>
            <img src="assets/images/chef2.png" alt="Chef" class="img-fluid chef-image">
        </div>
    </section>

    <!-- Success Notification -->
          <div id="success-popup" class="success-popup">
            Siparişiniz Alındı
          </div>


    <!-- Food Cards Section -->
    <section class="popular py-5">
        <div class="container">
            <h2 class="text-center mb-4">Popüler Kategoriler</h2>
            <div class="row">
                <?php
                include('php/db_connect.php');
                $query = "SELECT * FROM Food";
                $result = $conn->query($query);
                if ($result->num_rows > 0):
                    while ($row = $result->fetch_assoc()): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm food-card">
                                <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                    <p class="card-text">
                                        Ücret: ₺<span class="price"><?php echo $row['price']; ?></span>
                                    </p>
                                    <div class="quantity-section">
                                        <label for="quantity-<?php echo $row['id']; ?>">Adet:</label>
                                        <input type="number" class="form-control quantity-input" id="quantity-<?php echo $row['id']; ?>" value="1" min="1">
                                    </div>
                                    <button class="btn btn-outline-primary add-to-basket-btn" data-id="<?php echo $row['id']; ?>" data-price="<?php echo $row['price']; ?>"> Sepete Ekle </button>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                else: ?>
                    <p>Hiçbir Sıpariş Bulunamadı!</p>
<?php endif; ?>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4">
        <div class="container d-flex justify-content-between">
            <p>© 2024 Dönerdünyası. All rights reserved.</p>
            <div>
                <a href="#" class="text-light mx-2">Gizlilik Politikası</a>
                <a href="#" class="text-light mx-2">Hizmet Şartları</a>
            </div>
        </div>
    </footer>

    <script src="./assets/js/scripts.js"></script>
</body>
</html>
