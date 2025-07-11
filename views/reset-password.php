<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
    <link rel="stylesheet" href="../assets/css/reset-password.css">
</head>
<body>
    <section class="forgot-password">
        <div class="form-container">
            <h1>Đặt lại mật khẩu mới</h1>
            <p>Vui lòng nhập email đã đăng ký của bạn. Chúng tôi sẽ gửi một liên kết để đặt lại mật khẩu.</p>
            <form action="process-forgot-password.php" method="POST">
                <div class="input-group">
                    <input type="password" name="new_password" placeholder="Mật khẩu mới" required><br>
                    <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu" required><br>
                </div>
                <button type="submit" class="submit-btn">Xác nhận</button>
            </form>
            <a href="login.php" class="back-link">Quay lại trang đăng nhập</a>
        </div>
    </section>
</body>
</html>