<?php
class Security {
    
    /**
     * Generate CSRF Token
     */
    public static function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    /**
     * Verify CSRF Token
     */
    public static function verifyCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    /**
     * Sanitize input data
     */
    public static function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }
    
    /**
     * Validate email format
     */
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    /**
     * Check password strength
     */
    public static function checkPasswordStrength($password) {
        $score = 0;
        $feedback = [];
        
        // Length check
        if (strlen($password) >= 8) {
            $score++;
        } else {
            $feedback[] = 'at least 8 characters';
        }
        
        // Lowercase check
        if (preg_match('/[a-z]/', $password)) {
            $score++;
        } else {
            $feedback[] = 'lowercase letter';
        }
        
        // Uppercase check
        if (preg_match('/[A-Z]/', $password)) {
            $score++;
        } else {
            $feedback[] = 'uppercase letter';
        }
        
        // Number check
        if (preg_match('/\d/', $password)) {
            $score++;
        } else {
            $feedback[] = 'number';
        }
        
        // Special character check
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            $score++;
        } else {
            $feedback[] = 'special character';
        }
        
        $strength = 'weak';
        if ($score >= 4) $strength = 'strong';
        elseif ($score >= 3) $strength = 'good';
        elseif ($score >= 2) $strength = 'fair';
        
        return [
            'score' => $score,
            'strength' => $strength,
            'feedback' => $feedback
        ];
    }
    
    /**
     * Generate secure random password
     */
    public static function generateRandomPassword($length = 12) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        return substr(str_shuffle($chars), 0, $length);
    }
    
    /**
     * Rate limiting for login attempts
     */
    public static function checkRateLimit($identifier) {
        $attempts_key = 'login_attempts_' . $identifier;
        $lockout_key = 'login_lockout_' . $identifier;
        
        // Check if locked out
        if (isset($_SESSION[$lockout_key]) && $_SESSION[$lockout_key] > time()) {
            return false;
        }
        
        // Initialize attempts if not set
        if (!isset($_SESSION[$attempts_key])) {
            $_SESSION[$attempts_key] = 0;
        }
        
        return $_SESSION[$attempts_key] < MAX_LOGIN_ATTEMPTS;
    }
    
    /**
     * Record failed login attempt
     */
    public static function recordFailedAttempt($identifier) {
        $attempts_key = 'login_attempts_' . $identifier;
        $lockout_key = 'login_lockout_' . $identifier;
        
        if (!isset($_SESSION[$attempts_key])) {
            $_SESSION[$attempts_key] = 0;
        }
        
        $_SESSION[$attempts_key]++;
        
        // Lock out after max attempts
        if ($_SESSION[$attempts_key] >= MAX_LOGIN_ATTEMPTS) {
            $_SESSION[$lockout_key] = time() + LOGIN_LOCKOUT_TIME;
        }
    }
    
    /**
     * Clear login attempts on successful login
     */
    public static function clearLoginAttempts($identifier) {
        $attempts_key = 'login_attempts_' . $identifier;
        $lockout_key = 'login_lockout_' . $identifier;
        
        unset($_SESSION[$attempts_key]);
        unset($_SESSION[$lockout_key]);
    }
    
    /**
     * Log security events
     */
    public static function logSecurityEvent($event, $details = []) {
        $log_entry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'event' => $event,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'details' => $details
        ];
        
        // In a real application, you would log this to a file or database
        error_log('Security Event: ' . json_encode($log_entry));
    }
}
?>
