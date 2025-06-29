<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="../assets/css/forgot-password.css">
</head>
<body>
    <section class="forgot-password">
        <div class="form-container">
            <h1>Quên Mật Khẩu</h1>
            <p>Vui lòng nhập email đã đăng ký của bạn. Chúng tôi sẽ gửi một liên kết để đặt lại mật khẩu.</p>
            <form action="process-forgot-password.php" method="POST">
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required placeholder="Nhập email của bạn">
                </div>
                <button type="submit" class="submit-btn">Gửi Yêu Cầu</button>
            </form>
            <a href="login.php" class="back-link">Quay lại trang đăng nhập</a>
        </div>
    </section>
</body>
</html>
