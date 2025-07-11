<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/UserModel.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $otp = $_POST['otp'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (!isset($_SESSION['reset_otp']) || !isset($_SESSION['reset_user_id'])) {
        echo "Phiên reset không hợp lệ!";
        exit;
    }

    if ($otp != $_SESSION['reset_otp']) {
        echo "<script>alert('Mã xác nhận không đúng!'); window.history.back();</script>";
        exit;
    }

    if ($new_password !== $confirm_password) {
        echo "<script>alert('Mật khẩu nhập lại không khớp!'); window.history.back();</script>";
        exit;
    }

    $userModel = new UserModel();
    $userId = $_SESSION['reset_user_id'];
    $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password = :password WHERE id = :id";
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":password", $hashedPassword);
    $stmt->bindParam(":id", $userId);

    if ($stmt->execute()) {
        // Xóa session
        unset($_SESSION['reset_otp']);
        unset($_SESSION['reset_user_id']);

        echo "<script>alert('Đặt lại mật khẩu thành công!'); window.location.href='../views/login.php';</script>";
        exit;
    } else {
        echo "Có lỗi xảy ra!";
        exit;
    }
}
?>
