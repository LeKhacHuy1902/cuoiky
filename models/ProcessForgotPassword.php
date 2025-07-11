<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

$db = new Database();
$conn = $db->getConnection();

// Lấy email từ form
$email = $_POST['email'] ?? '';

if (!$email) {
    die('Vui lòng nhập email');
}

// Kiểm tra email có tồn tại không
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user) {
    die('Email không tồn tại trong hệ thống');
}

// Tạo OTP (token ngắn)
$otp = random_int(100000, 999999);
$expires = date('Y-m-d H:i:s', strtotime('+10 minutes'));

// Lưu OTP vào DB
$stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
$stmt->execute([$otp, $expires, $email]);

// Gửi email
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ngochaukiet123@gmail.com'; 
    $mail->Password = 'yuitncdmwxmwmxrm';        
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('ngochaukiet123@gmail.com', 'Hệ thống đặt lịch rửa xe');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Mã OTP xác minh đặt lại mật khẩu';
    $mail->Body    = "Mã OTP của bạn là: <b>$otp</b>. Mã này có hiệu lực trong 10 phút.";

    $mail->send();
} catch (Exception $e) {
    die("Không thể gửi email. Lỗi: {$mail->ErrorInfo}");
}

// Lưu email vào session để kiểm tra ở bước OTP
$_SESSION['reset_email'] = $email;

// Chuyển sang trang nhập OTP
echo "<script>
    alert('Đã gửi mã OTP. Vui lòng kiểm tra email và nhập OTP.');
    window.location.href = '../views/otp.php';
</script>";
exit;
?>