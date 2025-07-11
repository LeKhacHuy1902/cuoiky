<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Đơn Hàng</title>
    <link rel="stylesheet" href="../../assets/css/order.css">
</head>
<body>
    <div class="manage-orders">
        <header>
            <h1>Quản Lý Đơn Hàng</h1>
            <a href="dashboard.php" class="back-btn">← Quay lại</a>
        </header>

        <table>
            <thead>
                <tr>
                    <th>ID Đơn</th>
                    <th>Tên Khách</th>
                    <th>Dịch Vụ</th>
                    <th>Giá</th>
                    <th>Trạng Thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $orders = [
                    ['id' => 1, 'customer' => 'Nguyễn Văn A', 'service' => 'Rửa xe cơ bản', 'price' => '100,000 VNĐ', 'status' => 'Chờ xử lý'],
                    ['id' => 2, 'customer' => 'Trần Thị B', 'service' => 'Sửa xe nhỏ', 'price' => '200,000 VNĐ', 'status' => 'Chờ xử lý'],
                ];
                foreach ($orders as $order) {
                    echo "<tr>
                            <td>{$order['id']}</td>
                            <td>{$order['customer']}</td>
                            <td>{$order['service']}</td>
                            <td>{$order['price']}</td>
                            <td>{$order['status']}</td>
                            <td>
                                <button class='confirm-btn'>Xác nhận</button>
                                <button class='cancel-btn'>Hủy đơn</button>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
