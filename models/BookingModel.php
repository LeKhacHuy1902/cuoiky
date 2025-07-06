<?php
require_once __DIR__ . '/../config/database.php';

class BookingModel {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Lấy tất cả bookings
    public function getAllBookings() {
        $sql = "SELECT * FROM bookings ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
