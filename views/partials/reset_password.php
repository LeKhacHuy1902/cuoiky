<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đặt lại mật khẩu</title>
</head>
<body>
    <h2>Nhập mã xác nhận & mật khẩu mới</h2>
    <form action="models/process_reset_password.php" method="POST">
        <input type="text" name="otp" placeholder="Mã xác nhận" required><br>
        <input type="password" name="new_password" placeholder="Mật khẩu mới" required><br>
        <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu" required><br>
        <button type="submit">Xác nhận</button>
    </form>
</body>
</html>
