<?php

require_once __DIR__ . '/../config/database.php';

class BookingModel {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /**
     * Tạo đặt lịch mới
     */
    public function createBooking(
        int $user_id,
        string $address,
        string $email,
        string $bookings_date,
        float $total_price,
        string $note,
        array $serviceIds = []
    ): int|false {
        try {
            // 1. Insert booking
            $sql = "INSERT INTO bookings (user_id, address, bookings_date, total_price, status, note, email)
                    VALUES (:user_id, :address, :bookings_date, :total_price, 'ĐANG CHỜ XỬ LÝ', :note, :email)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->bindParam(":address", $address);
            $stmt->bindParam(":bookings_date", $bookings_date);
            $stmt->bindParam(":total_price", $total_price);
            $stmt->bindParam(":note", $note);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $bookingId = (int)$this->conn->lastInsertId();

            // 2. Insert dịch vụ liên quan
            foreach ($serviceIds as $serviceId) {
                $sqlPrice = "SELECT price FROM services WHERE id = :serviceId";
                $stmtPrice = $this->conn->prepare($sqlPrice);
                $stmtPrice->bindParam(":serviceId", $serviceId, PDO::PARAM_INT);
                $stmtPrice->execute();
                $price = $stmtPrice->fetchColumn();
                if ($price !== false) {
                    $sqlService = "INSERT INTO bookings_services (bookings_id, services_id, price_at_booking)
                                   VALUES (:bookingId, :serviceId, :price)";
                    $stmtService = $this->conn->prepare($sqlService);
                    $stmtService->bindParam(":bookingId", $bookingId, PDO::PARAM_INT);
                    $stmtService->bindParam(":serviceId", $serviceId, PDO::PARAM_INT);
                    $stmtService->bindParam(":price", $price);
                    $stmtService->execute();
                }
            }

            return $bookingId;
        } catch (PDOException $e) {
            error_log("Lỗi khi tạo booking: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy danh sách đặt lịch của người dùng
     */
    public function getUserBookings(int $userId): array {
        $stmt = $this->conn->prepare("SELECT * FROM bookings WHERE user_id = :user_id ORDER BY bookings_date DESC");
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
