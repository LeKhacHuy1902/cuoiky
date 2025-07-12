<?php
require_once __DIR__ . '/../../models/AdminModel.php';
$adminModel = new AdminModel();
$conn = $adminModel->getConnection();

// Xử lý xác nhận đơn hàng
if (isset($_POST['confirm_id'])) {
    $id = intval($_POST['confirm_id']);
    $adminModel->updateBookingStatus($id, 'ĐÃ HOÀN THÀNH');
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Xử lý hủy đơn hàng
if (isset($_POST['cancel_id'])) {
    $id = intval($_POST['cancel_id']);
    $adminModel->deleteBooking($id);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Lấy danh sách đơn hàng
$sql = "SELECT 
            b.id AS booking_id,
            u.username,
            u.full_name,
            b.address,
            b.bookings_date,
            GROUP_CONCAT(s.name_services SEPARATOR ', ') AS services,
            b.total_price,
            b.status
        FROM bookings b
        JOIN users u ON b.user_id = u.id
        JOIN bookings_services bs ON b.id = bs.bookings_id
        JOIN services s ON bs.services_id = s.id
        GROUP BY b.id
        ORDER BY b.bookings_date DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Tính doanh thu
$today = date('Y-m-d');
$month = (int)date('m');  // Ép kiểu số nguyên
$year = (int)date('Y');   // Ép kiểu số nguyên

$revenueDay = $adminModel->getRevenueByDate($today);
$revenueMonth = $adminModel->getRevenueByMonth($year, $month);
$revenueYear = $adminModel->getRevenueByYear($year);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đơn Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1b1b1b, #333, #555);
            color: #fff;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        .manage-orders {
            max-width: 1200px;
            margin: auto;
            background: linear-gradient(135deg, #1b1b1b, #333, #555);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
        }
        h1 {
            color: #ffa500;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2em;
        }
        .revenue-summary {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .revenue-summary h2 {
            color: #ffa500;
            margin-top: 0;
        }
        .revenue-summary p {
            margin: 5px 0;
            font-size: 1.1em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }
        table th, table td {
            border: 1px solid #444;
            padding: 12px 15px;
            text-align: left;
        }
        table th {
            background: #222;
            color: #ffa500;
            font-size: 1.1em;
        }
        table tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.05);
        }
        table td:last-child {
            text-align: center;
        }
        button {
            background: #ffa500;
            color: #000;
            border: none;
            padding: 7px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-weight: bold;
            margin: 2px;
        }
        button:hover {
            background: #ff8000;
            transform: scale(1.05);
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            background: #ffa500;
            color: #000;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .back-btn:hover {
            background: #ff8000;
        }
    </style>
</head>
<body>
    <div class="manage-orders">
        <header>
            <h1>Quản Lý Đơn Hàng</h1>
            <a href="dashboard.php" class="back-btn">← Quay lại</a>
        </header>

        <div class="revenue-summary">
            <h2>Thống kê Doanh Thu</h2>
            <p>Hôm nay: <strong><?= number_format($revenueDay, 0, ',', '.') ?> VNĐ</strong></p>
            <p>Tháng này: <strong><?= number_format($revenueMonth, 0, ',', '.') ?> VNĐ</strong></p>
            <p>Năm nay: <strong><?= number_format($revenueYear, 0, ',', '.') ?> VNĐ</strong></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID Đơn</th>
                    <th>Tên Khách (Username)</th>
                    <th>Dịch Vụ</th>
                    <th>Giá</th>
                    <th>Ngày Đặt</th>
                    <th>Địa Chỉ</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($orders as $order) {
                    echo "<tr>
                            <td>{$order['booking_id']}</td>
                            <td>";
                    $name = !empty($order['full_name']) ? $order['full_name'] : 'Không tên';
                    $username = $order['username'];
                    echo "{$name} ({$username})";
                    echo "</td>
                            <td>{$order['services']}</td>
                            <td>" . number_format($order['total_price'], 0, ',', '.') . " VNĐ</td>
                            <td>" . substr($order['bookings_date'], 0, 10) . "</td>
                            <td>{$order['address']}</td>
                            <td>{$order['status']}</td>
                            <td>";
                    if ($order['status'] !== 'ĐÃ HỦY' && $order['status'] !== 'ĐÃ HOÀN THÀNH') {
                        echo "
                            <form method='post' style='display:inline;'>
                                <input type='hidden' name='confirm_id' value='{$order['booking_id']}'>
                                <button type='submit'>Xác nhận</button>
                            </form>
                            <form method='post' style='display:inline;'>
                                <input type='hidden' name='cancel_id' value='{$order['booking_id']}'>
                                <button type='submit'>Hủy đơn</button>
                            </form>
                        ";
                    }
                    echo "</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>