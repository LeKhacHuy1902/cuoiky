<?php
require_once __DIR__ . '/../config/database.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

try {
    $db = new Database();
    $conn = $db->getConnection();

    $user_id = $_SESSION['user']['id'];

    $sql = "SELECT b.id AS booking_id, b.bookings_date, b.address, s.name_services
            FROM bookings b
            JOIN bookings_services bs ON b.id = bs.bookings_id
            JOIN services s ON bs.services_id = s.id
            WHERE b.user_id = :user_id
            ORDER BY b.bookings_date DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    error_log("Lỗi: " . $e->getMessage());
    $services = [];
}
?>