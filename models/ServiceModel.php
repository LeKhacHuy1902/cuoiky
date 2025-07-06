<?php
require_once __DIR__ . '/../config/database.php';

class ServiceModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Lấy tất cả dịch vụ
    public function getAllServices() {
        $sql = "SELECT * FROM services ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy dịch vụ theo ID
    public function getServiceById($id) {
        $sql = "SELECT * FROM services WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>