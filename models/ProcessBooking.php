<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../models/BookingModel.php';
require_once __DIR__ . '/../models/ServiceModel.php';

$serviceModel = new ServiceModel();
$bookingModel = new BookingModel();
$services = $serviceModel->getAllServices();

$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION["user"])) {
    $full_name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $bookings_date = $_POST['date'];
    $note = $_POST['notes'] ?? '';
    $serviceIds = $_POST['services'] ?? [];

    // Tính tổng tiền
    $total_price = 0;
    foreach ($serviceIds as $serviceId) {
        foreach ($services as $service) {
            if ($service['id'] == $serviceId) {
                $total_price += $service['price'];
            }
        }
    }

    $userId = $_SESSION["user"]["id"];

    // Gọi model để lưu booking
    $bookingId = $bookingModel->createBooking($userId, $full_name, $address, $bookings_date, $phone, $total_price, $note, $serviceIds);

    if ($bookingId) {
        $successMessage = "Đặt lịch thành công! Mã đơn: #" . $bookingId;
    } else {
        $successMessage = "Đặt lịch thất bại, vui lòng thử lại.";
    }
}
?>