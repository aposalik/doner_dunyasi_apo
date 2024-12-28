<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üye olmak</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <!-- Signup Form -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg" style="width: 24rem;">
            <h2 class="text-center mb-4">Üye ol</h2>
            <form action="php/signup.php" method="POST">
                <div class="form-group">
                    <label for="name">Ad Soyad</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-success btn-block hover-effect">Üye ol</button>
            </form>
            <p class="text-center mt-3">
                 Zaten bir hesabınız var mı? <a href="index.php" class="text-success">Giriş yap</a>
            </p>
        </div>
    </div>
</body>
</html>
