<?php
require_once __DIR__ . '/../config/database.php';

class UserModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Đăng ký
    public function register($username, $password, $email, $phone, $full_name) {
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

            $sql = "INSERT INTO users (username, password, email, phone, full_name) 
                    VALUES (:username, :password, :email, :phone, :full_name)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hashedPassword);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":full_name", $full_name);

            if ($stmt->execute()) {
                return true;
            } else {
                return "Đăng ký thất bại!";
            }
        } catch (PDOException $e) {
            return "Lỗi: " . $e->getMessage();
        }
    }

    // Đăng nhập
    public function login($username, $password) {
        try {
            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            return "Lỗi: " . $e->getMessage();
        }
    }

    // Lấy thông tin user
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật thông tin
    public function updateProfile($id, $full_name, $phone, $email) {
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
    }

    // Kiểm tra tồn tại username
    public function checkUsernameExists($username) {
        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetchColumn() ? true : false;
    }

    // Kiểm tra tồn tại email
    public function checkEmailExists($email, $ignoreId = null) {
        $sql = "SELECT id FROM users WHERE email = :email";
        if ($ignoreId) {
            $sql .= " AND id != :ignoreId";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        if ($ignoreId) {
            $stmt->bindParam(":ignoreId", $ignoreId);
        }
        $stmt->execute();
        return $stmt->fetchColumn() ? true : false;
    }

    // Kiểm tra tồn tại phone
    public function checkPhoneExists($phone, $ignoreId = null) {
        $sql = "SELECT id FROM users WHERE phone = :phone";
        if ($ignoreId) {
            $sql .= " AND id != :ignoreId";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":phone", $phone);
        if ($ignoreId) {
            $stmt->bindParam(":ignoreId", $ignoreId);
        }
        $stmt->execute();
        return $stmt->fetchColumn() ? true : false;
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
?>