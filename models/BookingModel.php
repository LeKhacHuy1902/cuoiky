<?php
require_once __DIR__ . '/../config/database.php';

class BookingModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function createBooking($user_id, $address, $email, $bookings_date, $total_price, $note, $serviceIds = []) {
        try {
            $sql = "INSERT INTO bookings (user_id, address, bookings_date, total_price, status, note, email)
                VALUES (:user_id, :address, :bookings_date, :total_price, 'ĐANG CHỜ XỬ LÝ', :note, :email)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":address", $address);
            $stmt->bindParam(":bookings_date", $bookings_date);
            $stmt->bindParam(":total_price", $total_price);
            $stmt->bindParam(":note", $note);
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            // ✅ Check lỗi SQL nếu có
            if ($stmt->errorCode() !== '00000') {
                echo "<pre>";
                print_r($stmt->errorInfo());
                echo "</pre>";
                return false;
            }

            $bookingId = $this->conn->lastInsertId();

            // Insert dịch vụ
            foreach ($serviceIds as $serviceId) {
                $sqlPrice = "SELECT price FROM services WHERE id = :serviceId";
                $stmtPrice = $this->conn->prepare($sqlPrice);
                $stmtPrice->bindParam(":serviceId", $serviceId);
                $stmtPrice->execute();
                $price = $stmtPrice->fetchColumn();

                $sqlService = "INSERT INTO bookings_services (bookings_id, services_id, price_at_booking)
                               VALUES (:bookingId, :serviceId, :price)";
                $stmtService = $this->conn->prepare($sqlService);
                $stmtService->bindParam(":bookingId", $bookingId);
                $stmtService->bindParam(":serviceId", $serviceId);
                $stmtService->bindParam(":price", $price);
                $stmtService->execute();

                // ✅ Check lỗi SQL nếu có
                if ($stmtService->errorCode() !== '00000') {
                    echo "<pre>";
                    print_r($stmtService->errorInfo());
                    echo "</pre>";
                    return false;
                }
            }

            return $bookingId;
        } catch (PDOException $e) {
            echo "Lỗi khi tạo booking: " . $e->getMessage();
            return false;
        }
    }
}
?>