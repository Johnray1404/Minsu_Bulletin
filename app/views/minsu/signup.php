<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - MINSU e-News Bulletin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e5e5e5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
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
        .message {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 4px;
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
        .input-field {
            margin-bottom: 15px;
            width: 100%;
            display: flex;
            align-items: center;
            position: relative;
        }
        .input-field input {
            padding: 10px;
            width: 300px; 
            border: none;
            border-radius: 4px;
        }
        .input-field input[type="text"],
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
        .btn-signup {
            background-color: #d4d9d4;
            color: #2c5f2d; 
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-weight: bold; 
        }
        .btn-signup:hover {
            background-color: #c3c9c3;
        }
        .login-prompt {
            margin-top: 15px;
            font-size: 0.9em;
            text-align: center; 
        }
        .login-prompt a {
            color: #a1e4a1;
            text-decoration: none;
        }
        .login-prompt a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="/public/images/minsu.jpg" alt="MINSU Logo">
        <h2>Sign Up</h2>
        <!-- views/minsu/verify_email.php -->
<?php if (isset($success)): ?>
    <p><?= $success ?></p>
<?php elseif (isset($error)): ?>
    <p><?= $error ?></p>
<?php endif; ?>


        <?php if (isset($data['error'])): ?>
            <div class="message error" id="message-error"><?php echo $data['error']; ?></div>
        <?php elseif (isset($data['success'])): ?>
            <div class="message success" id="message-success"><?php echo $data['success']; ?></div>
        <?php endif; ?>

        <form action="/signup" method="POST">
            <div class="input-field">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-field">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <i class="fas fa-eye toggle-password" onclick="togglePassword('password')"></i>
            </div>
            <div class="input-field">
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
                <i class="fas fa-eye toggle-password" onclick="togglePassword('confirm-password')"></i>
            </div>
            <button type="submit" class="btn-signup">Sign Up</button>
        </form>
        <div class="login-prompt">
            Already have an account? <a href="/">Login</a>
        </div>
    </div>

    <script>
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.querySelector(`#${inputId} + .toggle-password`);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        window.onload = function() {
            const errorMessage = document.getElementById('message-error');
            const successMessage = document.getElementById('message-success');
            
            if (errorMessage) {
                setTimeout(function() {
                    errorMessage.style.opacity = 0;
                }, 3000);
            }

            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.opacity = 0;
                    window.location.href = '/'; // Redirect to login after 3 seconds
                }, 3000);
            }
        };
    </script>
</body>
</html>
