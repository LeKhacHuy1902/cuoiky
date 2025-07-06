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
            $stmt->execute();

            return true;
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
                return $user; // Trả về thông tin user
            }
            return false;
        } catch (PDOException $e) {
            return false;
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
        return $stmt->execute();
    }

    // Quên mật khẩu (reset)
    public function resetPassword($email, $newPassword) {
        if (!$this->checkEmailExists($email)) {
            return "Email không tồn tại!";
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = :password WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":email", $email);
        return $stmt->execute();
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
}
?>