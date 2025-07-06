<?php
require_once __DIR__ . '/../config/database.php';

class OrderModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Lấy danh sách đơn của user
    public function getBookingsByUser($userId) {
        $sql = "SELECT * FROM bookings WHERE user_id = :userId ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy chi tiết 1 booking
    public function getBookingDetail($bookingId, $userId) {
        $sql = "SELECT b.*, GROUP_CONCAT(s.name SEPARATOR ', ') AS services
                FROM bookings b
                JOIN bookings_services bs ON b.id = bs.bookings_id
                JOIN services s ON bs.services_id = s.id
                WHERE b.id = :bookingId AND b.user_id = :userId
                GROUP BY b.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":bookingId", $bookingId);
        $stmt->bindParam(":userId", $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật booking
    public function updateBooking($bookingId, $userId, $full_name, $phone, $email, $address, $bookings_date, $note, $serviceIds = []) {
        try {
            // Kiểm tra trạng thái
            $sqlCheck = "SELECT status FROM bookings WHERE id = :bookingId AND user_id = :userId";
            $stmtCheck = $this->conn->prepare($sqlCheck);
            $stmtCheck->bindParam(":bookingId", $bookingId);
            $stmtCheck->bindParam(":userId", $userId);
            $stmtCheck->execute();
            $status = $stmtCheck->fetchColumn();

            if ($status !== "ĐANG CHỜ XỬ LÝ") {
                return false; // Không cho sửa khi đã chuyển trạng thái
            }

            // Cập nhật thông tin người dùng
            $sqlUpdateUser = "UPDATE users SET full_name = :full_name, phone = :phone, email = :email WHERE id = :userId";
            $stmtUpdateUser = $this->conn->prepare($sqlUpdateUser);
            $stmtUpdateUser->bindParam(":full_name", $full_name);
            $stmtUpdateUser->bindParam(":phone", $phone);
            $stmtUpdateUser->bindParam(":email", $email);
            $stmtUpdateUser->bindParam(":userId", $userId);
            $stmtUpdateUser->execute();

            // Cập nhật thông tin booking
            $sqlUpdateBooking = "UPDATE bookings 
                                 SET address = :address, bookings_date = :bookings_date, note = :note
                                 WHERE id = :bookingId AND user_id = :userId";
            $stmtBooking = $this->conn->prepare($sqlUpdateBooking);
            $stmtBooking->bindParam(":address", $address);
            $stmtBooking->bindParam(":bookings_date", $bookings_date);
            $stmtBooking->bindParam(":note", $note);
            $stmtBooking->bindParam(":bookingId", $bookingId);
            $stmtBooking->bindParam(":userId", $userId);
            $stmtBooking->execute();

            // Xóa dịch vụ cũ
            $sqlDeleteServices = "DELETE FROM bookings_services WHERE bookings_id = :bookingId";
            $stmtDelete = $this->conn->prepare($sqlDeleteServices);
            $stmtDelete->bindParam(":bookingId", $bookingId);
            $stmtDelete->execute();

            // Insert dịch vụ mới & tính tổng
            $total = 0;
            foreach ($serviceIds as $serviceId) {
                $sqlPrice = "SELECT price FROM services WHERE id = :serviceId";
                $stmtPrice = $this->conn->prepare($sqlPrice);
                $stmtPrice->bindParam(":serviceId", $serviceId);
                $stmtPrice->execute();
                $price = $stmtPrice->fetchColumn();
                $total += $price;

                $sqlInsert = "INSERT INTO bookings_services (bookings_id, services_id, price_at_booking)
                              VALUES (:bookingId, :serviceId, :price)";
                $stmtInsert = $this->conn->prepare($sqlInsert);
                $stmtInsert->bindParam(":bookingId", $bookingId);
                $stmtInsert->bindParam(":serviceId", $serviceId);
                $stmtInsert->bindParam(":price", $price);
                $stmtInsert->execute();
            }

            // Update tổng tiền
            $sqlUpdateTotal = "UPDATE bookings SET total_price = :total WHERE id = :bookingId";
            $stmtTotal = $this->conn->prepare($sqlUpdateTotal);
            $stmtTotal->bindParam(":total", $total);
            $stmtTotal->bindParam(":bookingId", $bookingId);
            $stmtTotal->execute();

            return true;
        } catch (PDOException $e) {
            echo "Lỗi khi cập nhật booking: " . $e->getMessage();
            return false;
        }
    }

    // Hủy booking
    public function cancelBooking($bookingId, $userId) {
        $sqlCheck = "SELECT status FROM bookings WHERE id = :bookingId AND user_id = :userId";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->bindParam(":bookingId", $bookingId);
        $stmtCheck->bindParam(":userId", $userId);
        $stmtCheck->execute();
        $status = $stmtCheck->fetchColumn();

        if ($status !== "ĐANG CHỜ XỬ LÝ") {
            return false;
        }

        $sql = "UPDATE bookings SET status = 'ĐÃ HỦY' WHERE id = :bookingId AND user_id = :userId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":bookingId", $bookingId);
        $stmt->bindParam(":userId", $userId);
        return $stmt->execute();
    }
}
?>