<?php
require_once '../config/auth.php';
require_once '../models/BookingModel.php';

// Kiểm tra đăng nhập
requireLogin();

$bookingModel = new BookingModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Xử lý đặt lịch
    $userId    = currentUser()['id'];
    $serviceId = $_POST['service_id'] ?? null;
    $date      = $_POST['date'] ?? null;
    $time      = $_POST['time'] ?? null;
    $carId     = $_POST['car_id'] ?? null;
    $note      = $_POST['note'] ?? null;

    $result = $bookingModel->createBooking($userId, $serviceId, $date, $time, $carId, $note);

    if ($result) {
        $success = "Đặt lịch thành công!";
    } else {
        $error = "Lỗi khi đặt lịch!";
    }

    include '../views/booking.php';

} else {
    // Lấy lịch sử đặt lịch
    $bookings = $bookingModel->getUserBookings(currentUser()['id']);
    include '../views/booking.php';
}
