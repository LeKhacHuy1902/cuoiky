<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Rửa Xe Thể Thao</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-banner">
            <h1>Rửa Xe Thể Thao</h1>
            <p>Đồng hành cùng bạn trên mọi chặng đường!</p>
        </div>
        <div class="login-form">
            <h2>Đăng Nhập</h2>
            <form action="process_login.php" method="POST">
                <input type="text" name="username" placeholder="Tên đăng nhập" required>
                <input type="password" name="password" placeholder="Mật khẩu" required>
                <button type="submit" class="login-btn">Đăng Nhập</button>
            </form>
            <div class="login-options">
                <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
                <p><a href="forgot-password.php">Quên mật khẩu?</a></p>
            </div>
        </div>
    </div>
</body>
</html>
