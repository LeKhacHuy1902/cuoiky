<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/database.php';

$db = new Database();
$conn = $db->getConnection();

$period = $_GET['period'] ?? 'day';

$now = date('Y-m-d H:i:s');

switch ($period) {
    case 'day':
        $start = date('Y-m-d 00:00:00');
        break;
    case 'week':
        $start = date('Y-m-d 00:00:00', strtotime('monday this week'));
        break;
    case 'month':
        $start = date('Y-m-01 00:00:00');
        break;
    case 'year':
        $start = date('Y-01-01 00:00:00');
        break;
    default:
        $start = date('Y-m-d 00:00:00');
}

// Người dùng mới
$stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE created_at BETWEEN ? AND ?");
$stmt->execute([$start, $now]);
$userCount = $stmt->fetchColumn();

// Tổng dịch vụ đã bán (tổng số lượt dịch vụ trong bookings_services)
$stmt = $conn->prepare("SELECT COUNT(*) FROM bookings_services bs
    JOIN bookings b ON bs.bookings_id = b.id
    WHERE b.created_at BETWEEN ? AND ?");
$stmt->execute([$start, $now]);
$serviceCount = $stmt->fetchColumn();

// Tổng đơn hàng
$stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE created_at BETWEEN ? AND ?");
$stmt->execute([$start, $now]);
$orderCount = $stmt->fetchColumn();

// Doanh thu (tổng total_price từ orders)
$stmt = $conn->prepare("SELECT SUM(total_price) FROM orders WHERE created_at BETWEEN ? AND ?");
$stmt->execute([$start, $now]);
$revenue = $stmt->fetchColumn();
$revenue = $revenue ? number_format($revenue, 0, ',', '.') . ' đ' : '0 đ';

// Trả về JSON
echo json_encode([
    'users' => (int)$userCount,
    'services' => (int)$serviceCount,
    'orders' => (int)$orderCount,
    'revenue' => $revenue
]);
?>