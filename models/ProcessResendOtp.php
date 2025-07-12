<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/SendMail.php'; // Nếu có file send mail riêng

$db = new Database();
$conn = $db->getConnection();

$email = $_SESSION['reset_email'] ?? '';

if (!$email) {
    die("Không tìm thấy email trong session. Vui lòng thực hiện lại.");
}

// Tạo mã OTP mới
$newOtp = random_int(100000, 999999);
$expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

// Lưu vào DB
$stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
$stmt->execute([$newOtp, $expiry, $email]);

// Gửi mail
sendResetOtp($email, $newOtp);
echo "<script>
    alert('Mã OTP mới đã được gửi lại email!');
    window.history.back();
</script>";
exit;
