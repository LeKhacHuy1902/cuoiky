<?php
session_start();
require_once __DIR__ . '/BookingModel.php';

// Tạm gán user_id để test trực tiếp
$userId = 1; // Hoặc ID thực tế của user muốn test

$bookingModel = new BookingModel();
$bookings = $bookingModel->getUserBookings($userId);

echo "<pre>";
print_r($bookings);
echo "</pre>";
exit;
?>
