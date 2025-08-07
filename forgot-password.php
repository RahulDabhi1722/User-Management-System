<?php
session_start();
require_once "config/Database.php";
require_once "classes/User.php";

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // In a real application, you would:
        // 1. Generate a secure reset token
        // 2. Store it in the database with expiration
        // 3. Send an email with the reset link
        
        $message = "If this email exists in our system, you will receive a password reset link shortly.";
        $messageType = "success";
    } else {
        $message = "Please enter a valid email address.";
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - User Authentication</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-header">
            <h2><i class="fas fa-key"></i> Forgot Password</h2>
            <p>Enter your email to reset your password</p>
        </div>
        
        <div class="form-content">
            <?php if ($message): ?>
                <div class="alert alert-<?= $messageType ?>">
                    <i class="fas fa-<?= $messageType === 'success' ? 'check-circle' : 'exclamation-circle' ?>"></i> 
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" id="forgotForm">
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
                
                <button type="submit" class="btn" id="forgotBtn">
                    <span class="btn-text">Send Reset Link</span>
                    <span class="loading" style="display: none;"></span>
                </button>
            </form>
            
            <div class="form-links">
                <p>Remember your password? <a href="login.php">Sign in here</a></p>
                <p>Don't have an account? <a href="register.php">Create one here</a></p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('forgotForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('forgotBtn');
            const btnText = btn.querySelector('.btn-text');
            const loading = btn.querySelector('.loading');
            
            btnText.style.display = 'none';
            loading.style.display = 'inline-block';
            btn.disabled = true;
        });

        // Interactive feedback
        const input = document.querySelector('input');
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    </script>
</body>
</html>
