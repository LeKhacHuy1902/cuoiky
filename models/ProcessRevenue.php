<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/AdminModel.php';

// Trả dữ liệu JSON
header('Content-Type: application/json');

// Khởi tạo model
$model = new AdminModel();

// Lấy ngày, tháng, năm hiện tại
$today = date('Y-m-d');
$month = date('m');
$year = date('Y');

// Tính doanh thu
$revenueDay = $model->getRevenueByDate($today);
$revenueMonth = $model->getRevenueByMonth($year, $month);
$revenueYear = $model->getRevenueByYear($year);

// Trả dữ liệu về JSON
echo json_encode([
    'day' => $revenueDay,
    'month' => $revenueMonth,
    'year' => $revenueYear
]);
exit;
?>