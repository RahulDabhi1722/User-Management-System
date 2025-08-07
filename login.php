<?php
session_start();
require_once "config/Database.php";
require_once "classes/User.php";

$db = (new Database())->connect();
$user = new User($db);

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = trim($_POST['email_or_username']);
    $password = $_POST['password'];

    $loggedUser = $user->login($input, $password);

    if ($loggedUser) {
        $_SESSION['user'] = $loggedUser;
        header("Location: home.php");
        exit;
    } else {
        $message = "Invalid credentials! Please check your email/username and password.";
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - User Authentication</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h2><i class="fas fa-sign-in-alt"></i> Welcome Back</h2>
            <p>Sign in to your account</p>
        </div>
        
        <div class="form-content">
            <?php if ($message): ?>
                <div class="alert alert-<?= $messageType ?>">
                    <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" id="loginForm">
                <div class="form-group">
                    <label for="email_or_username">
                        <i class="fas fa-user"></i> Email or Username
                    </label>
                    <input 
                        type="text" 
                        id="email_or_username"
                        name="email_or_username" 
                        placeholder="Enter your email or username" 
                        required
                        value="<?= isset($_POST['email_or_username']) ? htmlspecialchars($_POST['email_or_username']) : '' ?>"
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
                        placeholder="Enter your password" 
                        required
                    >
                </div>
                
                <button type="submit" class="btn" id="loginBtn">
                    <span class="btn-text">Sign In</span>
                    <span class="loading" style="display: none;"></span>
                </button>
            </form>
            
            <div class="form-links">
                <p>Don't have an account? <a href="register.php">Create one here</a></p>
                <p><a href="forgot-password.php">Forgot your password?</a></p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            const btnText = btn.querySelector('.btn-text');
            const loading = btn.querySelector('.loading');
            
            btnText.style.display = 'none';
            loading.style.display = 'inline-block';
            btn.disabled = true;
        });

        // Add some interactive feedback
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
