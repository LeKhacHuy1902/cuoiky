<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once __DIR__ . '/../config/database.php';

$db = new Database();
$conn = $db->getConnection();

// Kiểm tra session cho phép đặt lại
if (!isset($_SESSION['reset_email']) || !isset($_SESSION['allow_reset'])) {
    die("Không xác định được yêu cầu đặt lại mật khẩu.");
}

$email = $_SESSION['reset_email'];

// Lấy dữ liệu từ form
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

if (empty($new_password) || empty($confirm_password)) {
    die("Vui lòng nhập đầy đủ mật khẩu.");
}

if ($new_password !== $confirm_password) {
    die("Hai mật khẩu không khớp.");
}

// Hash mật khẩu mới
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Update vào DB
$stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE email = ?");
$result = $stmt->execute([$hashed_password, $email]);

if ($result) {
    // Xóa session
    unset($_SESSION['reset_email']);
    unset($_SESSION['allow_reset']);
    
    echo "<script>alert('Cập nhật mật khẩu thành công. Bạn có thể đăng nhập lại.'); window.location.href = '../views/login.php';</script>";
    exit;
} else {
    die("Có lỗi xảy ra khi cập nhật mật khẩu.");
}
?>