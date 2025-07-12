<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php'; // Nếu dùng Composer

function sendResetOtp($toEmail, $otp) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ngochaukiet123@gmail.com'; // Email gửi
        $mail->Password   = 'yuitncdmwxmwmxrm';   // App password (của Gmail)
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        $mail->CharSet = 'UTF-8';
        // Recipients
        $mail->setFrom('your_email@gmail.com', 'AutoCare');
        $mail->addAddress($toEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Mã OTP xác thực';
        $mail->Body    = "Mã OTP của bạn là: <strong>$otp</strong><br>Mã có hiệu lực trong 10 phút.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Lỗi gửi email: {$mail->ErrorInfo}";
        return false;
    }
}
