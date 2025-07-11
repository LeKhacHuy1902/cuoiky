<?php
require_once __DIR__ . '/../config/database.php';
session_start();

// ⚠️ Đảm bảo đã đăng nhập trước, hoặc tạm gán user_id
if (!isset($_SESSION['user'])) {
    // Tạm gán ID user thử nếu chưa login (ví dụ id = 1)
    $_SESSION['user'] = ['id' => 1, 'full_name' => 'Nguyễn Văn A'];
}

try {
    $db = new Database();
    $conn = $db->getConnection();

    $user_id = $_SESSION['user']['id'];
    $bookings_date = date('Y-m-d H:i:s', strtotime('+2 days 14:00')); // ví dụ ngày giờ
    $phone = '0987654321';
    $address = '123 Đường Lê Lợi, Quận 1';
    $total_price = 500000;
    $note = 'Test booking';

    // Insert booking
    $sql = "INSERT INTO bookings (user_id, bookings_date, phone, address, total_price, note) 
            VALUES (:user_id, :bookings_date, :phone, :address, :total_price, :note)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':bookings_date', $bookings_date);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':total_price', $total_price);
    $stmt->bindParam(':note', $note);
    $stmt->execute();

    $booking_id = $conn->lastInsertId();

    // Insert service (giả sử service id = 1)
    $services_id = 1;
    $services_price = 500000;

    $sql2 = "INSERT INTO bookings_services (bookings_id, services_id, services_price) 
             VALUES (:bookings_id, :services_id, :services_price)";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindParam(':bookings_id', $booking_id);
    $stmt2->bindParam(':services_id', $services_id);
    $stmt2->bindParam(':services_price', $services_price);
    $stmt2->execute();

    echo "Đã thêm booking thử thành công! Booking ID: $booking_id";
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}