<?php  
require_once __DIR__ . '/../config/database.php';  

class UserModel {     
    private PDO $conn;  

    public function __construct() {         
        $db = new Database();         
        $this->conn = $db->getConnection();     
    }          

<<<<<<< HEAD
    // Đăng ký tài khoản mới
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
=======
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
>>>>>>> de83045bf12d6f68027b3556629832593ba38be4

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);              

            $sql = "INSERT INTO users (username, password_hash, email, phone, full_name, role) 
                    VALUES (:username, :password_hash, :email, :phone, :full_name, 'customer')";             
            $stmt = $this->conn->prepare($sql);             
            $stmt->bindParam(":username", $username);             
            $stmt->bindParam(":password_hash", $hashedPassword);             
            $stmt->bindParam(":email", $email);             
            $stmt->bindParam(":phone", $phone);             
            $stmt->bindParam(":full_name", $full_name);              

            if ($stmt->execute()) {                 
                return true;             
            } else {                 
                return "Đăng ký thất bại!";             
            }         
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
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Lấy thông tin người dùng theo ID
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật thông tin người dùng
    public function updateProfile($id, $full_name, $phone, $email) {
        if ($this->checkEmailExists($email, $id)) {
            return "Email đã tồn tại!";
        }
        if ($this->checkPhoneExists($phone, $id)) {
            return "Số điện thoại đã tồn tại!";
        }
=======
            if ($user && password_verify($password, $user['password_hash'])) {                 
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
>>>>>>> de83045bf12d6f68027b3556629832593ba38be4

    public function updateProfile(int $id, string $full_name, string $phone, string $email): bool|string {         
        if ($this->checkEmailExists($email, $id)) {             
            return "Email đã tồn tại!";         
        }         
        if ($this->checkPhoneExists($phone, $id)) {             
            return "Số điện thoại đã tồn tại!";         
        }          

<<<<<<< HEAD
    // Đặt lại mật khẩu
    public function resetPassword($email, $newPassword) {
        if (!$this->checkEmailExists($email)) {
            return "Email không tồn tại!";
        }
=======
        $sql = "UPDATE users SET full_name = :full_name, phone = :phone, email = :email WHERE id = :id";         
        $stmt = $this->conn->prepare($sql);         
        $stmt->bindParam(":full_name", $full_name);         
        $stmt->bindParam(":phone", $phone);         
        $stmt->bindParam(":email", $email);         
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);          
>>>>>>> de83045bf12d6f68027b3556629832593ba38be4

        if ($stmt->execute()) {             
            return true;         
        } else {             
            return "Cập nhật thất bại!";         
        }     
    }      

<<<<<<< HEAD
    // Kiểm tra username đã tồn tại
    public function checkUsernameExists($username) {
        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetchColumn() ? true : false;
    }

    // Kiểm tra email đã tồn tại (có thể bỏ qua ID hiện tại nếu cập nhật)
    public function checkEmailExists($email, $ignoreId = null) {
        $sql = "SELECT id FROM users WHERE email = :email";
        if ($ignoreId !== null) {
            $sql .= " AND id != :ignoreId";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        if ($ignoreId !== null) {
            $stmt->bindParam(":ignoreId", $ignoreId);
        }
        $stmt->execute();
        return $stmt->fetchColumn() ? true : false;
    }

    // Kiểm tra số điện thoại đã tồn tại (có thể bỏ qua ID hiện tại nếu cập nhật)
    public function checkPhoneExists($phone, $ignoreId = null) {
        $sql = "SELECT id FROM users WHERE phone = :phone";
        if ($ignoreId !== null) {
            $sql .= " AND id != :ignoreId";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":phone", $phone);
        if ($ignoreId !== null) {
            $stmt->bindParam(":ignoreId", $ignoreId);
        }
        $stmt->execute();
        return $stmt->fetchColumn() ? true : false;
    }

    // Người dùng đánh giá dịch vụ
    public function rate($user_id, $bookings_id, $rate, $comment) {
        try {
=======
    public function resetPassword(string $email, string $newPassword): bool|string {         
        if (!$this->checkEmailExists($email)) {             
            return "Email không tồn tại!";         
        }          

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);         
        $sql = "UPDATE users SET password_hash = :password_hash WHERE email = :email";         
        $stmt = $this->conn->prepare($sql);         
        $stmt->bindParam(":password_hash", $hashedPassword);         
        $stmt->bindParam(":email", $email);          

        if ($stmt->execute()) {             
            return true;         
        } else {             
            return "Đặt lại mật khẩu thất bại!";         
        }     
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
    public function rate(int $user_id, int $bookings_id, int $rate, string $comment): bool|string {         
        try {             
>>>>>>> de83045bf12d6f68027b3556629832593ba38be4
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
