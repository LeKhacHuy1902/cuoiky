<?php
require_once __DIR__ . '/../models/ServiceModel.php';
require_once __DIR__ . '/../models/BookingModel.php';

$serviceModel = new ServiceModel();
$bookingModel = new BookingModel();

$services = $serviceModel->getAllServices();
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION["user"])) {
        die("Vui lòng đăng nhập để đặt lịch!");
    }

    $userId = $_SESSION["user"]["id"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $date = $_POST["date"];
    $notes = $_POST["notes"] ?? "";
    $selectedServices = $_POST["services"] ?? [];

    if (empty($selectedServices)) {
        die("Bạn chưa chọn dịch vụ nào!");
    }

    // Tính tổng tiền và ép kiểu float
    $totalPrice = 0.0;
    foreach ($selectedServices as $serviceId) {
        $service = $serviceModel->getServiceById($serviceId);
        if ($service) {
            $totalPrice += (float)$service["price"];
        }
    }

    // Ép kiểu float khi truyền vào hàm
    $bookingId = $bookingModel->createBooking(
        $userId,
        $address,
        $email,
        $date,
        $phone,
        (float)$totalPrice,
        $notes,
        $selectedServices
    );

    if ($bookingId !== false) {
        $successMessage = "Đặt lịch thành công!";
    } else {
        $successMessage = "Có lỗi xảy ra khi đặt lịch!";
    }
}
?>