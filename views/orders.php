<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn Hàng Của Tôi</title>
    <link rel="stylesheet" href="../assets/css/orders.css">
</head>
<body>
    <section class="customer-orders">
        <header>
            <h1>Đơn Hàng Của Tôi</h1>
        </header>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Dịch Vụ</th>
                    <th>Ngày Đặt</th>
                    <th>Giá</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Giả lập danh sách đơn hàng của khách hàng
                $orders = [
                    ['id' => 1, 'service' => 'Rửa xe cơ bản', 'date' => '2025-06-22', 'price' => '100,000 VNĐ', 'status' => 'Đang xử lý'],
                    ['id' => 2, 'service' => 'Sửa xe nhỏ', 'date' => '2025-06-21', 'price' => '200,000 VNĐ', 'status' => 'Hoàn thành'],
                ];

                foreach ($orders as $order) {
                    echo "<tr>
                            <td>{$order['id']}</td>
                            <td>{$order['service']}</td>
                            <td>{$order['date']}</td>
                            <td>{$order['price']}</td>
                            <td>{$order['status']}</td>
                            <td>
                                <button class='view-btn'>Chi Tiết</button>
                                <button class='cancel-btn'>Hủy</button>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</body>
</html>
