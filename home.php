<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - User Authentication</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard">
        <div class="dashboard-header">
            <h1><i class="fas fa-tachometer-alt"></i> Welcome, <?= htmlspecialchars($user['full_name']) ?>!</h1>
            <p>Your account dashboard</p>
        </div>
        
        <div class="dashboard-content">
            <div class="user-info">
                <h3><i class="fas fa-user-circle"></i> Profile Information</h3>
                
                <div class="info-item">
                    <span class="info-label"><i class="fas fa-user"></i> Full Name:</span>
                    <span class="info-value"><?= htmlspecialchars($user['full_name']) ?></span>
                </div>
                
                <div class="info-item">
                    <span class="info-label"><i class="fas fa-at"></i> Username:</span>
                    <span class="info-value"><?= htmlspecialchars($user['username']) ?></span>
                </div>
                
                <div class="info-item">
                    <span class="info-label"><i class="fas fa-envelope"></i> Email:</span>
                    <span class="info-value"><?= htmlspecialchars($user['email']) ?></span>
                </div>
                
                <div class="info-item">
                    <span class="info-label"><i class="fas fa-calendar-alt"></i> Member Since:</span>
                    <span class="info-value"><?= isset($user['created_at']) ? date('F j, Y', strtotime($user['created_at'])) : 'Unknown' ?></span>
                </div>
            </div>
            
            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <button class="btn" style="flex: 1; min-width: 200px;" onclick="editProfile()">
                    <i class="fas fa-edit"></i> Edit Profile
                </button>
                
                <button class="btn" style="flex: 1; min-width: 200px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%);" onclick="changePassword()">
                    <i class="fas fa-key"></i> Change Password
                </button>
                
                <button class="btn" style="flex: 1; min-width: 200px; background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
        </div>
    </div>

    <script>
        function editProfile() {
            alert('Profile editing feature coming soon!');
        }
        
        function changePassword() {
            alert('Change password feature coming soon!');
        }
        
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'logout.php';
            }
        }
        
        // Add some nice animations
        const dashboard = document.querySelector('.dashboard');
        dashboard.style.animation = 'slideUp 0.6s ease-out';
        
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px) scale(1.02)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>
