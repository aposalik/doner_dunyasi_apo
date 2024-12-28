<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Animated Background */
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6d5dfc, #c048ff);
            animation: gradientAnimation 5s infinite alternate;
        }

        /* Contact Section */
        .contact-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
        }

        .contact-box {
            background: white;
            border-radius: 15px;
            width: 250px;
            height: 150px;
            margin: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: #333;
        }

        .contact-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .contact-box i {
            font-size: 40px;
            color: #6d5dfc;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        .contact-box:hover i {
            color: #c048ff;
        }

        .contact-box h5 {
            font-size: 18px;
            font-weight: bold;
        }

        .contact-box p {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Contact Section -->
    <div class="container text-center mt-5">
        <h1 class="text-white mb-5">Contact Us</h1>
        <div class="contact-container">
            <!-- Facebook -->
            <a href="https://facebook.com/Abdullah Salik" target="_blank" class="contact-box">
                <i class="fab fa-facebook"></i>
                <h5>Facebook</h5>
                <p>@Abdullah Salik</p>
            </a>

            <!-- Instagram -->
            <a href="https://instagram.com/salik_apo" target="_blank" class="contact-box">
                <i class="fab fa-instagram"></i>
                <h5>Instagram</h5>
                <p>@salik_apo</p>
            </a>

            <!-- X (Twitter) -->
            <a href="https://x.com/apo_salik" target="_blank" class="contact-box">
                <i class="fab fa-twitter"></i>
                <h5>X (Twitter)</h5>
                <p>@apo_salik</p>
            </a>

            <!-- GitHub -->
            <a href="https://github.com/aposalik" target="_blank" class="contact-box">
                <i class="fab fa-github"></i>
                <h5>GitHub</h5>
                <p>@aposalik</p>
            </a>

            <!-- LinkedIn -->
            <a href="https://www.linkedin.com/in/abdullah-salik-18bb2425a?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" target="_blank" class="contact-box">
                <i class="fab fa-linkedin"></i>
                <h5>LinkedIn</h5>
                <p>Abdullah Salik</p>
            </a>

            <!-- Phone -->
            <div class="contact-box">
                <i class="fas fa-phone-alt"></i>
                <h5>Phone</h5>
                <p>+90 551-0501-303</p>
            </div>

            <!-- Email -->
            <div class="contact-box">
                <i class="fas fa-envelope"></i>
                <h5>Email</h5>
                <p>abdullahsalik1153@gmail.com</p>
            </div>
        </div>
    </div>
</body>
</html>
