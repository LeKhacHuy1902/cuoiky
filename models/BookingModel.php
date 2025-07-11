<?php

require_once __DIR__ . '/../config/database.php';

class BookingModel {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function createBooking(
        int $user_id,
        string $full_name,
        string $address,
        string $bookings_date,
        string $phone,
        float $total_price,
        string $note,
        array $serviceIds = []
    ): int|false {
        try {
            // Insert booking
            $sql = "INSERT INTO bookings (user_id, full_name, address, bookings_date, phone, total_price, status, note)
                    VALUES (:user_id, :full_name, :address, :bookings_date, :phone, :total_price, 'ĐANG CHỜ XỬ LÝ', :note)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->bindParam(":full_name", $full_name);
            $stmt->bindParam(":address", $address);
            $stmt->bindParam(":bookings_date", $bookings_date);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":total_price", $total_price);
            $stmt->bindParam(":note", $note);
            $stmt->execute();

            $bookingId = (int)$this->conn->lastInsertId();

            // Insert dịch vụ liên quan
            foreach ($serviceIds as $serviceId) {
                $sqlPrice = "SELECT price FROM services WHERE id = :serviceId";
                $stmtPrice = $this->conn->prepare($sqlPrice);
                $stmtPrice->bindParam(":serviceId", $serviceId, PDO::PARAM_INT);
                $stmtPrice->execute();
                $price = $stmtPrice->fetchColumn();

                if ($price !== false) {
                    $sqlService = "INSERT INTO bookings_services (bookings_id, services_id, services_price)
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
            echo "Lỗi DB: " . $e->getMessage();
            exit;
        }
    }

    public function getUserBookings(int $userId): array {
        $sql = "SELECT 
                    b.*, 
                    s.id AS service_id,
                    s.name_services,
                    bs.services_price
                FROM bookings b
                LEFT JOIN bookings_services bs ON b.id = bs.bookings_id
                LEFT JOIN services s ON bs.services_id = s.id
                WHERE b.user_id = :user_id
                ORDER BY b.bookings_date DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $bookings = [];
        foreach ($rows as $row) {
            $bookingId = $row['id'];
            if (!isset($bookings[$bookingId])) {
                $bookings[$bookingId] = [
                    'id' => $row['id'],
                    'user_id' => $row['user_id'],
                    'full_name' => $row['full_name'],
                    'bookings_date' => $row['bookings_date'],
                    'phone' => $row['phone'],
                    'address' => $row['address'],
                    'status' => $row['status'],
                    'created_at' => $row['created_at'],
                    'total_price' => $row['total_price'],
                    'note' => $row['note'],
                    'services' => [],
                ];
            }

            if (!empty($row['service_id'])) {
                $bookings[$bookingId]['services'][] = [
                    'id' => $row['service_id'],
                    'name' => $row['name_services'],
                    'price' => $row['services_price'],
                ];
            }
        }

        return array_values($bookings);
    }
}
?>