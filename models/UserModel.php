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
            if ($this->checkUsernameExists($username)) return "Username đã tồn tại!";             
            if ($this->checkEmailExists($email)) return "Email đã tồn tại!";             
            if ($this->checkPhoneExists($phone)) return "Số điện thoại đã tồn tại!";             

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);             

            $sql = "INSERT INTO users (username, password, email, phone, full_name, role) 
                VALUES (:username, :password, :email, :phone, :full_name, 'user')";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $hashedPassword);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":phone", $phone);
                $stmt->bindParam(":full_name", $full_name);
          

            return $stmt->execute() ? true : "Đăng ký thất bại!";         
        } catch (PDOException $e) {             
            error_log("Đăng ký lỗi: " . $e->getMessage());             
            return "Lỗi: " . $e->getMessage();         
        }     
    }      

    public function login(string $username, string $password): array|false {         
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
            error_log("Login error: " . $e->getMessage());             
            return false;         
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
        if ($this->checkEmailExists($email, $id)) return "Email đã tồn tại!";         
        if ($this->checkPhoneExists($phone, $id)) return "Số điện thoại đã tồn tại!";         

        $sql = "UPDATE users SET full_name = :full_name, phone = :phone, email = :email WHERE id = :id";         
        $stmt = $this->conn->prepare($sql);         
        $stmt->bindParam(":full_name", $full_name);         
        $stmt->bindParam(":phone", $phone);         
        $stmt->bindParam(":email", $email);         
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);         

        return $stmt->execute() ? true : "Cập nhật thất bại!";     
    }      

    public function resetPassword(string $email, string $newPassword): bool|string {         
        if (!$this->checkEmailExists($email)) return "Email không tồn tại!";         

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);         
        $sql = "UPDATE users SET password_hash = :password_hash WHERE email = :email";         
        $stmt = $this->conn->prepare($sql);         
        $stmt->bindParam(":password_hash", $hashedPassword);         
        $stmt->bindParam(":email", $email);         

        return $stmt->execute() ? true : "Đặt lại mật khẩu thất bại!";     
    }      

    public function checkUsernameExists(string $username): bool {         
        $sql = "SELECT id FROM users WHERE username = :username";         
        $stmt = $this->conn->prepare($sql);         
        $stmt->bindParam(":username", $username);         
        $stmt->execute();         
        return (bool)$stmt->fetchColumn();     
    }      

    public function checkEmailExists(string $email, ?int $ignoreId = null): bool {         
        $sql = "SELECT id FROM users WHERE email = :email";         
        if ($ignoreId) $sql .= " AND id != :ignoreId";         
        $stmt = $this->conn->prepare($sql);         
        $stmt->bindParam(":email", $email);         
        if ($ignoreId) $stmt->bindParam(":ignoreId", $ignoreId, PDO::PARAM_INT);         
        $stmt->execute();         
        return (bool)$stmt->fetchColumn();     
    }      

    public function checkPhoneExists(string $phone, ?int $ignoreId = null): bool {         
        $sql = "SELECT id FROM users WHERE phone = :phone";         
        if ($ignoreId) $sql .= " AND id != :ignoreId";         
        $stmt = $this->conn->prepare($sql);         
        $stmt->bindParam(":phone", $phone);         
        if ($ignoreId) $stmt->bindParam(":ignoreId", $ignoreId, PDO::PARAM_INT);         
        $stmt->execute();         
        return (bool)$stmt->fetchColumn();     
    }      
}
?>