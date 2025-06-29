<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>
    <link rel="stylesheet" href="../../assets/css/users.css">
</head>
<body>
    <div class="manage-users">
        <header>
            <h1>Quản Lý Người Dùng</h1>
        </header>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Vai Trò</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $users = [
                    ['id' => 1, 'name' => 'Nguyễn Văn A', 'email' => 'nguyenvana@gmail.com', 'phone' => '0123456789', 'role' => 'admin'],
                    ['id' => 2, 'name' => 'Trần Thị B', 'email' => 'tranthib@gmail.com', 'phone' => '0987654321', 'role' => 'user'],
                ];
                foreach ($users as $user) {
                    echo "<tr>
                            <td>{$user['id']}</td>
                            <td>{$user['name']}</td>
                            <td>{$user['email']}</td>
                            <td>{$user['phone']}</td>
                            <td>{$user['role']}</td>
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
