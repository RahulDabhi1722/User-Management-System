<?php
class User {
    private $conn;
    private $table = "registration";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($fullName, $username, $email, $password) {
        try {
            // Check if email or username already exists
            if ($this->emailExists($email) || $this->usernameExists($username)) {
                return false;
            }

            $query = "INSERT INTO " . $this->table . " (full_name, username, email, password, created_at)
                      VALUES (:full_name, :username, :email, :password, NOW())";
            $stmt = $this->conn->prepare($query);

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt->bindParam(":full_name", $fullName);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashedPassword);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Registration error: " . $e->getMessage());
            return false;
        }
    }

    public function login($emailOrUsername, $password) {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE email = :input OR username = :input LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":input", $emailOrUsername);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Update last login time
                $this->updateLastLogin($user['id']);
                // Remove password from returned data for security
                unset($user['password']);
                return $user;
            }

            return false;
        } catch (PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            return false;
        }
    }

    public function emailExists($email) {
        try {
            $query = "SELECT id FROM " . $this->table . " WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Email check error: " . $e->getMessage());
            return false;
        }
    }

    public function usernameExists($username) {
        try {
            $query = "SELECT id FROM " . $this->table . " WHERE username = :username LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Username check error: " . $e->getMessage());
            return false;
        }
    }

    public function getUserById($id) {
        try {
            $query = "SELECT id, full_name, username, email, created_at, last_login FROM " . $this->table . " WHERE id = :id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Get user error: " . $e->getMessage());
            return false;
        }
    }

    public function updateProfile($id, $fullName, $username, $email) {
        try {
            $query = "UPDATE " . $this->table . " SET full_name = :full_name, username = :username, email = :email WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(":full_name", $fullName);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Update profile error: " . $e->getMessage());
            return false;
        }
    }

    public function updatePassword($id, $newPassword) {
        try {
            $query = "UPDATE " . $this->table . " SET password = :password WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt->bindParam(":password", $hashedPassword);
            $stmt->bindParam(":id", $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Update password error: " . $e->getMessage());
            return false;
        }
    }

    private function updateLastLogin($id) {
        try {
            $query = "UPDATE " . $this->table . " SET last_login = NOW() WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Update last login error: " . $e->getMessage());
        }
    }
}
?>
