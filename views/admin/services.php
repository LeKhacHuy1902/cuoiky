<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Dịch Vụ</title>
    <link rel="stylesheet" href="../../assets/css/services.css">
</head>
<body>
    <div class="manage-services">
        <header>
            <h1>Quản Lý Dịch Vụ</h1>
        </header>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Dịch Vụ</th>
                    <th>Mô Tả</th>
                    <th>Giá</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $services = [
                    ['id' => 1, 'name' => 'Rửa xe cơ bản', 'description' => 'Rửa sạch xe máy hoặc ô tô.', 'price' => '100,000 VNĐ'],
                    ['id' => 2, 'name' => 'Sửa xe nhỏ', 'description' => 'Sửa chữa các lỗi nhỏ như thay lốp, thay dầu.', 'price' => '200,000 VNĐ'],
                ];
                foreach ($services as $service) {
                    echo "<tr>
                            <td>{$service['id']}</td>
                            <td>{$service['name']}</td>
                            <td>{$service['description']}</td>
                            <td>{$service['price']}</td>
                            <td>
                                <button class='edit-btn'>Sửa</button>
                                <button class='delete-btn'>Xóa</button>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
