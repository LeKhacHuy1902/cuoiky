<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once __DIR__ . '/../config/database.php';

$db = new Database();
$conn = $db->getConnection();

// Lấy mã OTP từ form
$otp = $_POST['otp'] ?? '';

if (empty($otp)) {
    die("Vui lòng nhập mã OTP.");
}

// Debug: Hiển thị session email
$email = $_SESSION['reset_email'] ?? '';
if (!$email) {
    die("Không xác định được email trong session. Vui lòng gửi lại OTP.");
}


// Lấy thông tin từ DB
$stmt = $conn->prepare("SELECT reset_token, reset_token_expiry FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user) {
    die("Không tìm thấy người dùng với email này.");
}

// Kiểm tra OTP và hạn
if (
    $user['reset_token'] == $otp &&
    strtotime($user['reset_token_expiry']) > time()
) {
    // OTP hợp lệ
    $_SESSION['allow_reset'] = true;

    // Xóa OTP khỏi DB
    $stmt = $conn->prepare("UPDATE users SET reset_token = NULL, reset_token_expiry = NULL WHERE email = ?");
    $stmt->execute([$email]);

    header("Location: ../views/reset-password.php?email=" . urlencode($email));
    exit;
} else {
    echo "<script>alert('Mã OTP không hợp lệ hoặc đã hết hạn!'); window.history.back();</script>";
    exit;
}
?>
