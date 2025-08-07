<?php
session_start();
require_once "config/Database.php";
require_once "classes/User.php";

$db = (new Database())->connect();
$user = new User($db);

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validation
    $errors = [];
    
    if (empty($fullName)) $errors[] = "Full name is required";
    if (empty($username)) $errors[] = "Username is required";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters";
    if ($password !== $confirmPassword) $errors[] = "Passwords do not match";

    if (empty($errors)) {
        if ($user->register($fullName, $username, $email, $password)) {
            $message = "Registration successful! You can now login.";
            $messageType = "success";
            $_POST = [];
        } else {
            $message = "Email or username already exists. Please try different credentials.";
            $messageType = "error";
        }
    } else {
        $message = implode(", ", $errors);
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - User Authentication</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h2><i class="fas fa-user-plus"></i> Create Account</h2>
            <p>Join us today and get started</p>
        </div>
        
        <div class="form-content">
            <?php if ($message): ?>
                <div class="alert alert-<?= $messageType ?>">
                    <i class="fas fa-<?= $messageType === 'success' ? 'check-circle' : 'exclamation-circle' ?>"></i> 
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" id="registerForm">
                <div class="form-group">
                    <label for="full_name">
                        <i class="fas fa-user"></i> Full Name
                    </label>
                    <input 
                        type="text" 
                        id="full_name"
                        name="full_name" 
                        placeholder="Enter your full name" 
                        required
                        value="<?= isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : '' ?>"
                    >
                </div>
                
                <div class="form-group">
                    <label for="username">
                        <i class="fas fa-at"></i> Username
                    </label>
                    <input 
                        type="text" 
                        id="username"
                        name="username" 
                        placeholder="Choose a username" 
                        required
                        value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                    >
                </div>
                
                <div class="form-group">
                    <label for="email">
                        <i class="fas fa-envelope"></i> Email Address
                    </label>
                    <input 
                        type="email" 
                        id="email"
                        name="email" 
                        placeholder="Enter your email address" 
                        required
                        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                    >
                </div>
                
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input 
                        type="password" 
                        id="password"
                        name="password" 
                        placeholder="Create a strong password" 
                        required
                    >
                    <div class="password-strength">
                        <div class="strength-bar" id="strengthBar"></div>
                    </div>
                    <small id="strengthText" style="color: #666; font-size: 12px;"></small>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">
                        <i class="fas fa-lock"></i> Confirm Password
                    </label>
                    <input 
                        type="password" 
                        id="confirm_password"
                        name="confirm_password" 
                        placeholder="Confirm your password" 
                        required
                    >
                </div>
                
                <button type="submit" class="btn" id="registerBtn">
                    <span class="btn-text">Create Account</span>
                    <span class="loading" style="display: none;"></span>
                </button>
            </form>
            
            <div class="form-links">
                <p>Already have an account? <a href="login.php">Sign in here</a></p>
            </div>
        </div>
    </div>

    <script>
        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let feedback = [];
            
            if (password.length >= 8) strength++;
            else feedback.push('at least 8 characters');
            
            if (/[a-z]/.test(password)) strength++;
            else feedback.push('lowercase letter');
            
            if (/[A-Z]/.test(password)) strength++;
            else feedback.push('uppercase letter');
            
            if (/\d/.test(password)) strength++;
            else feedback.push('number');
            
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            else feedback.push('special character');

            strengthBar.className = 'strength-bar';
            if (strength >= 4) {
                strengthBar.classList.add('strength-strong');
                strengthText.textContent = 'Strong password';
            } else if (strength >= 3) {
                strengthBar.classList.add('strength-good');
                strengthText.textContent = 'Good password';
            } else if (strength >= 2) {
                strengthBar.classList.add('strength-fair');
                strengthText.textContent = 'Fair password';
            } else if (strength >= 1) {
                strengthBar.classList.add('strength-weak');
                strengthText.textContent = 'Weak password';
            } else {
                strengthText.textContent = 'Need: ' + feedback.join(', ');
            }
        });

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('registerBtn');
            const btnText = btn.querySelector('.btn-text');
            const loading = btn.querySelector('.loading');
            
            btnText.style.display = 'none';
            loading.style.display = 'inline-block';
            btn.disabled = true;
        });

        <?php if ($messageType === 'success'): ?>
        setTimeout(function() {
            
            const form = document.getElementById('registerForm');
            form.classList.add('form-clearing');
            
            setTimeout(function() {
                form.reset();
                form.classList.remove('form-clearing');
                document.getElementById('strengthBar').className = 'strength-bar';
                document.getElementById('strengthText').textContent = '';

                const btn = document.getElementById('registerBtn');
                const btnText = btn.querySelector('.btn-text');
                const loading = btn.querySelector('.loading');
                
                btnText.style.display = 'inline';
                loading.style.display = 'none';
                btn.disabled = false;

                const alert = document.querySelector('.alert-success');
                if (alert) {
                    alert.style.animation = 'pulse 0.5s';
                }
            }, 500);

            setTimeout(function() {
                if (confirm('Registration successful! Would you like to go to the login page?')) {
                    window.location.href = 'login.php';
                }
            }, 2000);
        }, 1000);
        <?php endif; ?>

        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>
