<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký - Rửa Xe Thể Thao</title>
    <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>
    <div class="register-container">
        <div class="register-banner">
            <h1>Chào Mừng Bạn</h1>
            <p>Tham gia cộng đồng chăm sóc xe hơi hàng đầu!</p>
        </div>
        <div class="register-form">
            <h2>Đăng Ký</h2>
            <form action="process_register.php" method="POST">
                <input type="text" name="fullname" placeholder="Họ và Tên" required>
                <input type="text" name="username" placeholder="Tên Đăng Nhập" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mật Khẩu" required>
                <input type="password" name="confirm_password" placeholder="Nhập Lại Mật Khẩu" required>
                <button type="submit" class="register-btn">Đăng Ký</button>
            </form>
            <div class="register-options">
                <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
            </div>
        </div>
    </div>
</body>
</html>
