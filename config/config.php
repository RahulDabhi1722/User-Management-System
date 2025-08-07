<?php
// Application Configuration
define('APP_NAME', 'User Authentication System');
define('APP_VERSION', '2.0');
define('APP_URL', 'http://user-auth.rf.gd');

// Security Configuration
define('SESSION_LIFETIME', 3600);
define('CSRF_TOKEN_NAME', 'csrf_token');
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_TIME', 300);

// Password Requirements
define('MIN_PASSWORD_LENGTH', 6);
define('REQUIRE_UPPERCASE', true);
define('REQUIRE_LOWERCASE', true);
define('REQUIRE_NUMBERS', true);
define('REQUIRE_SPECIAL_CHARS', false);

// Email Configuration
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', '');
define('SMTP_PASSWORD', '');
define('FROM_EMAIL', 'noreply@yourapp.com');
define('FROM_NAME', APP_NAME);

// File Upload Configuration
define('MAX_FILE_SIZE', 2 * 1024 * 1024); // 2MB
define('ALLOWED_FILE_TYPES', ['jpg', 'jpeg', 'png', 'gif']);
define('UPLOAD_PATH', 'uploads/');

// Timezone
date_default_timezone_set('UTC');

// Error Reporting
define('DEBUG_MODE', true);

if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
?>
