<?php
require_once __DIR__ . '/../config/database.php';

class AdminModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // ==================== USERS ====================
    //Lấy dữ liệu từ bảng users
    public function getAllUsers() {
        $sql = "SELECT * FROM users ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    //Sửa thông tin người dùng
    public function updateUser($id, $username, $email, $full_name, $phone) {
        $sql = "UPDATE users 
            SET username = :username, 
                email = :email, 
                full_name = :full_name, 
                phone = :phone 
            WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":full_name", $full_name);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }    
    
    //Xóa người dùng
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // ==================== BOOKINGS ====================
    //Lấy dữ liệu về đơn hàng
    public function getBookingDetails($bookingId) {
        $sql = "SELECT 
                b.id AS booking_id,
                b.user_id,
                u.username,
                u.full_name,
                u.email,
                u.phone,
                b.address,
                b.bookings_date,
                b.total_price,
                b.status,
                b.note,
                GROUP_CONCAT(s.name SEPARATOR ', ') AS services
            FROM bookings b
            JOIN users u ON b.user_id = u.id
            JOIN bookings_services bs ON b.id = bs.bookings_id
            JOIN services s ON bs.services_id = s.id
            WHERE b.id = :bookingId
            GROUP BY b.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":bookingId", $bookingId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* Giải thích vì thông tin đơn hàng có thể bao gồm cả bảng bookings và bảng users
    nên khi sửa có thể sửa bên user và cả bookings nên mới có viết hàm 2 phần như này*/
    public function updateBooking($id, $full_name, $email, $phone, $address, $bookings_date, $status, $newServiceIds = []) {
    try {
        // --- Update user ---
        $sqlUser = "UPDATE users 
                    SET full_name = :full_name,
                        email = :email,
                        phone = :phone
                    WHERE id = (SELECT user_id FROM bookings WHERE id = :bookingId LIMIT 1)";
        $stmtUser = $this->conn->prepare($sqlUser);
        $stmtUser->bindParam(":full_name", $full_name);
        $stmtUser->bindParam(":email", $email);
        $stmtUser->bindParam(":phone", $phone);
        $stmtUser->bindParam(":bookingId", $id);
        $stmtUser->execute();

        // --- Update booking (address, date, status) ---
        $sqlBooking = "UPDATE bookings 
                       SET address = :address,
                           bookings_date = :bookings_date,
                           status = :status
                       WHERE id = :id";
        $stmtBooking = $this->conn->prepare($sqlBooking);
        $stmtBooking->bindParam(":address", $address);
        $stmtBooking->bindParam(":bookings_date", $bookings_date);
        $stmtBooking->bindParam(":status", $status);
        $stmtBooking->bindParam(":id", $id);
        $stmtBooking->execute();

        // --- Lấy dịch vụ hiện tại ---
        $sql = "SELECT services_id FROM bookings_services WHERE bookings_id = :bookingId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":bookingId", $id);
        $stmt->execute();
        $currentServices = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // --- Xác định dịch vụ cần xóa ---
        $servicesToDelete = array_diff($currentServices, $newServiceIds);
        foreach ($servicesToDelete as $serviceId) {
            $sqlDel = "DELETE FROM bookings_services WHERE bookings_id = :bookingId AND services_id = :serviceId";
            $stmtDel = $this->conn->prepare($sqlDel);
            $stmtDel->bindParam(":bookingId", $id);
            $stmtDel->bindParam(":serviceId", $serviceId);
            $stmtDel->execute();
        }

        // --- Xác định dịch vụ cần thêm ---
        $servicesToAdd = array_diff($newServiceIds, $currentServices);
        foreach ($servicesToAdd as $serviceId) {
            // Lấy giá
            $sqlPrice = "SELECT price FROM services WHERE id = :serviceId";
            $stmtPrice = $this->conn->prepare($sqlPrice);
            $stmtPrice->bindParam(":serviceId", $serviceId);
            $stmtPrice->execute();
            $price = $stmtPrice->fetchColumn();

            // Insert dịch vụ mới
            $sqlInsert = "INSERT INTO bookings_services (bookings_id, services_id, price_at_booking)
                          VALUES (:bookingId, :serviceId, :price)";
            $stmtInsert = $this->conn->prepare($sqlInsert);
            $stmtInsert->bindParam(":bookingId", $id);
            $stmtInsert->bindParam(":serviceId", $serviceId);
            $stmtInsert->bindParam(":price", $price);
            $stmtInsert->execute();
        }

        // --- Tính tổng tiền mới ---
        $sqlTotal = "SELECT SUM(price_at_booking) FROM bookings_services WHERE bookings_id = :bookingId";
        $stmtTotal = $this->conn->prepare($sqlTotal);
        $stmtTotal->bindParam(":bookingId", $id);
        $stmtTotal->execute();
        $totalPrice = $stmtTotal->fetchColumn();

        // --- Update tổng tiền vào bookings ---
        $sqlUpdate = "UPDATE bookings SET total_price = :totalPrice WHERE id = :bookingId";
        $stmtUpdate = $this->conn->prepare($sqlUpdate);
        $stmtUpdate->bindParam(":totalPrice", $totalPrice);
        $stmtUpdate->bindParam(":bookingId", $id);
        $stmtUpdate->execute();

        return true;
        } catch (PDOException $e) {
        // Ghi log hoặc thông báo lỗi nếu cần
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    public function deleteBooking($bookingId) {
    try {
        // Kiểm tra trạng thái
        $sqlCheck = "SELECT status FROM bookings WHERE id = :bookingId";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->bindParam(":bookingId", $bookingId);
        $stmtCheck->execute();
        $status = $stmtCheck->fetchColumn();

        if ($status !== "ĐANG CHỜ XỬ LÝ") {
            echo "Chỉ có thể xóa đơn hàng đang chờ xử lý.";
            return false;
        }
        // --- Xóa các dịch vụ liên quan ---
        $sqlServices = "DELETE FROM bookings_services WHERE bookings_id = :bookingId";
        $stmtServices = $this->conn->prepare($sqlServices);
        $stmtServices->bindParam(":bookingId", $bookingId);
        $stmtServices->execute();

        // --- Xóa booking ---
        $sqlBooking = "DELETE FROM bookings WHERE id = :bookingId";
        $stmtBooking = $this->conn->prepare($sqlBooking);
        $stmtBooking->bindParam(":bookingId", $bookingId);
        $stmtBooking->execute();

        return true;
    } catch (PDOException $e) {
        echo "Lỗi khi xóa booking: " . $e->getMessage();
        return false;
    }
    }

    // ==================== DOANH THU ====================
    //Theo ngày
    public function getRevenueByDate($date) {
    $sql = "SELECT SUM(total_price) AS revenue 
            FROM bookings 
            WHERE DATE(bookings_date) = :date AND status = 'ĐÃ HOÀN THÀNH'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":date", $date);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['revenue'] ?? 0;
    }

    //theo tháng
    public function getRevenueByMonth($year, $month) {
    $sql = "SELECT SUM(total_price) AS revenue 
            FROM bookings 
            WHERE YEAR(bookings_date) = :year AND MONTH(bookings_date) = :month AND status = 'ĐÃ HOÀN THÀNH'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":year", $year);
    $stmt->bindParam(":month", $month);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['revenue'] ?? 0;
    }
    
    //theo năm
    public function getRevenueByYear($year) {
    $sql = "SELECT SUM(total_price) AS revenue 
            FROM bookings 
            WHERE YEAR(bookings_date) = :year AND status = 'ĐÃ HOÀN THÀNH'";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":year", $year);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['revenue'] ?? 0;
    }
}    
?>
