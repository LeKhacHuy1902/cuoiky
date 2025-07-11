<?php
require_once __DIR__ . '/../config/database.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../views/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $booking_id = intval($_POST['booking_id']);
    $user_id = $_SESSION['user']['id'];

    $db = new Database();
    $conn = $db->getConnection();

    // Chỉ xóa booking của user đang đăng nhập
    $sql = "DELETE FROM bookings WHERE id = :id AND user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $booking_id, PDO::PARAM_INT);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('Đã hủy đơn thành công!'); window.location.href = '../views/dich-vu-da-dat.php';</script>";
    } else {
        echo "<script>alert('Không thể hủy đơn!'); window.history.back();</script>";
    }
}
?>