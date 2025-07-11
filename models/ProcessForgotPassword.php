<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/UserModel.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = $_POST['email_or_phone'] ?? '';

    $userModel = new UserModel();

    // Tìm user theo email hoặc phone
    $sql = "SELECT * FROM users WHERE email = :input OR phone = :input";
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':input', $input);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Tạo mã OTP ngẫu nhiên
        $otp = rand(100000, 999999);

        // Lưu OTP vào session
        $_SESSION['reset_otp'] = $otp;
        $_SESSION['reset_user_id'] = $user['id'];

        // ✅ Gửi OTP qua email hoặc SMS
        // Tạm thời in ra màn hình (sau này tích hợp gửi mail hoặc sms)
        echo "Mã xác nhận (OTP): $otp <br>";
        echo "<a href='../reset_password.php'>Nhập mã tại đây</a>";
        exit;
    } else {
        echo "<script>alert('Không tìm thấy tài khoản!'); window.history.back();</script>";
        exit;
    }
}
?>
