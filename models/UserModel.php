<?php

require_once __DIR__ . '/../config/database.php';

class UserModel {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

   
    public function register(string $username, string $password, string $email, string $phone, string $full_name): bool|string {
        try {
            if ($this->checkUsernameExists($username)) {
                return "Username đã tồn tại!";
            }
            if ($this->checkEmailExists($email)) {
                return "Email đã tồn tại!";
            }
            if ($this->checkPhoneExists($phone)) {
                return "Số điện thoại đã tồn tại!";
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, password_hash, email, phone, full_name, role)
                    VALUES (:username, :password, :email, :phone, :full_name, 'customer')";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hashedPassword);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":full_name", $full_name);

<<<<<<< HEAD
            if ($stmt->execute()) {
                return true;
            } else {
                return "Đăng ký thất bại!";
            }
=======
            return $stmt->execute();

>>>>>>> 1b031585ad1e5d404c1445d14aa455d1341126c0
        } catch (PDOException $e) {
            error_log("Đăng ký lỗi: " . $e->getMessage());
            return "Lỗi hệ thống. Vui lòng thử lại sau.";
        }
    }

    public function login(string $username, string $password): array|false {
        try {
            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

<<<<<<< HEAD
            if ($user && password_verify($password, $user['password'])) {
=======
            if ($user && password_verify($password, $user['password_hash'])) {
>>>>>>> 1b031585ad1e5d404c1445d14aa455d1341126c0
                return $user;
            }

            return false;
        } catch (PDOException $e) {
<<<<<<< HEAD
            return "Lỗi: " . $e->getMessage();
=======
            error_log("Login error: " . $e->getMessage());
            return false;
>>>>>>> 1b031585ad1e5d404c1445d14aa455d1341126c0
        }
    }

    
    public function getUserById(int $id): array|false {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function updateProfile(int $id, string $full_name, string $phone, string $email): bool|string {
        if ($this->checkEmailExists($email, $id)) {
            return "Email đã tồn tại!";
        }
        if ($this->checkPhoneExists($phone, $id)) {
            return "Số điện thoại đã tồn tại!";
        }

        $sql = "UPDATE users SET full_name = :full_name, phone = :phone, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":full_name", $full_name);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":email", $email);
<<<<<<< HEAD
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Cập nhật thất bại!";
        }
    }

    // Reset mật khẩu (email hoặc phone)
    public function resetPasswordByEmailOrPhone($emailOrPhone, $newPassword) {
        $sql = "SELECT * FROM users WHERE email = :input OR phone = :input";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":input", $emailOrPhone);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return "Email hoặc số điện thoại không tồn tại!";
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sqlUpdate = "UPDATE users SET password = :password WHERE id = :id";
        $stmtUpdate = $this->conn->prepare($sqlUpdate);
        $stmtUpdate->bindParam(":password", $hashedPassword);
        $stmtUpdate->bindParam(":id", $user['id']);

        if ($stmtUpdate->execute()) {
            return true;
        } else {
            return "Đặt lại mật khẩu thất bại!";
        }
=======
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

   
    public function resetPassword(string $email, string $newPassword): bool|string {
        if (!$this->checkEmailExists($email)) {
            return "Email không tồn tại!";
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password_hash = :password WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":email", $email);

        return $stmt->execute();
>>>>>>> 1b031585ad1e5d404c1445d14aa455d1341126c0
    }

    
    public function checkUsernameExists(string $username): bool {
        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    
    public function checkEmailExists(string $email, ?int $ignoreId = null): bool {
        $sql = "SELECT id FROM users WHERE email = :email";
        if ($ignoreId) {
            $sql .= " AND id != :ignoreId";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        if ($ignoreId) {
            $stmt->bindParam(":ignoreId", $ignoreId, PDO::PARAM_INT);
        }
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    
    public function checkPhoneExists(string $phone, ?int $ignoreId = null): bool {
        $sql = "SELECT id FROM users WHERE phone = :phone";
        if ($ignoreId) {
            $sql .= " AND id != :ignoreId";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":phone", $phone);
        if ($ignoreId) {
            $stmt->bindParam(":ignoreId", $ignoreId, PDO::PARAM_INT);
        }
        $stmt->execute();
        return (bool) $stmt->fetchColumn();
    }

    // Đánh giá
    public function rate($user_id, $bookings_id, $rate, $comment) {
        try {
            $sql = "INSERT INTO rate (user_id, bookings_id, rate, comment) 
                    VALUES (:user_id, :bookings_id, :rate, :comment)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":bookings_id", $bookings_id);
            $stmt->bindParam(":rate", $rate);
            $stmt->bindParam(":comment", $comment);

            if ($stmt->execute()) {
                return true;
            } else {
                return "Gửi đánh giá thất bại!";
            }
        } catch (PDOException $e) {
            return "Lỗi: " . $e->getMessage();
        }
    }
}
