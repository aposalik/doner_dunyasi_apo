<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <!-- Gırıs Form -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg" style="width: 22rem;">
            <h2 class="text-center mb-4">Giriş</h2>
            <form action="php/login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block hover-effect">Login</button>
            </form>
            <p class="text-center mt-3">
                Hesabınız yok mu? <a href="signup.php" class="text-primary">Üye olmak</a>
            </p>
            <p class="text-center mt-1">
    <a href="admin_panel/admin_login.php" class="text-danger">Yönetici Girişi</a>
</p>
        </div>
    </div>
</body>
</html>
