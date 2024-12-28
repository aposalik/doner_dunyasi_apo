<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* General Page Styles */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('assets/images/Me2.jpg') center/cover no-repeat;
            color: white;
            text-align: center;
            padding: 150px 20px;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: bold;
        }

        .hero h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .hero .btn {
            font-size: 18px;
            padding: 10px 30px;
            border-radius: 20px;
            background: #ff4757;
            color: white;
            text-decoration: none;
        }

        .hero .btn:hover {
            background: #e84118;
        }

        /* About Section */
        .about-section {
            padding: 50px 20px;
            text-align: center;
            background: #f7f7f7;
        }

        .about-section .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 4px solid #ff4757;
        }

        .about-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .about-section p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #555;
        }

        .social-icons a {
            font-size: 24px;
            color: #555;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #ff4757;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero">
        <h1>I'm Abdullah Salik</h1>
        <h3>Software Engineer | Backend Progorammer</h3>
        <a href="https://github.com/aposalik" class="btn">Portfolio</a>
    </div>

    <!-- About Section -->
    <div class="about-section">
        <img src="assets/images/Me.jpg" alt="Abdullah's Profile" class="profile-pic">
        <h2>About Me</h2>
        <p>
            Hi! I'm Abdullah Salik, a passionate Software Engineer currently studying at Fırat University. <br>
            With a love for web development, I specialize in crafting modern, user-friendly websites and applications.
        </p>
        <div class="social-icons">
            <a href="https://facebook.com/Abdullah Salik" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://instagram.com/salik_apo" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://github.com/aposalik" target="_blank"><i class="fab fa-github"></i></a>
            <a href="https://www.linkedin.com/in/abdullah-salik-18bb2425a?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>
</body>
</html>
