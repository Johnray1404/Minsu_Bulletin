<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MINSU e-News Bulletin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('/public/images/background.jpg');
            background-size: cover;
            background-position: center;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay for better contrast */
            z-index: -1; /* Behind the content */
        }
        .container {
            background-color: #048506; 
            padding: 30px;
            width: 350px; 
            border-radius: 8px;
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center; 
        }
        .container img {
            width: 80px; 
            height: 80px;
            border-radius: 50%;
            margin-bottom: 15px;
        }
        .container h2 {
            margin: 0 0 20px; 
            text-align: center; 
        }
        .input-field {
            margin-bottom: 15px;
            width: 300px;
            display: flex;
            align-items: center;
            position: relative;
        }
        .input-field input {
            padding: 10px;
            width: 100%; 
            border: none;
            border-radius: 4px;
        }
        .input-field input[type="email"],
        .input-field input[type="password"] {
            background-color: #ffffff;
            color: #333;
        }
        .input-field .toggle-password {
            position: absolute;
            right: 15px; 
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #333; 
        }
        .btn-login {
            background-color: #d4d9d4;
            color: #2c5f2d; 
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 90%;
            font-weight: bold; 
        }
        .btn-login:hover {
            background-color: #c3c9c3;
        }
        .sign-up, .forgot-password {
            margin-top: 15px;
            font-size: 0.9em;
            text-align: center; 
        }
        .sign-up a, .forgot-password a {
            color: #a1e4a1;
            text-decoration: none;
        }
        .sign-up a:hover, .forgot-password a:hover {
            text-decoration: underline;
        }
        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            width: 100%;
            text-align: center;
            opacity: 1;
            transition: opacity 0.5s ease;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .hidden {
            opacity: 0;
        }
    </style>
</head>
<body>
    <div class="overlay"></div> <!-- Dark overlay for background contrast -->
    <div class="container">
        <img src="/public/images/minsu.jpg" alt="MINSU Logo">
        <h2>Login</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="message error" id="error-message"><?= htmlspecialchars($_SESSION['error']); ?></div>
            <?php unset($_SESSION['error']); ?> 
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="message success"><?= htmlspecialchars($_SESSION['success']); ?></div>
            <?php unset($_SESSION['success']); ?> 
        <?php endif; ?>
        <form action="/login" method="POST" id="login-form">
            <div class="input-field">
                <input type="text" name="email" placeholder="Email" required>
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
            </div><br>
            <button type="submit" class="btn-login">Login</button>
        </form>
        <div class="sign-up">
            Don't have an account? <a href="/signup">Sign up</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        window.onload = function() {
            const errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                setTimeout(function() {
                    errorMessage.classList.add('hidden');
                }, 3000);  
            }
        };
    </script>
</body>
</html>
