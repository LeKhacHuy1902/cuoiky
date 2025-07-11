<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/UserModel.php';

// Bắt đầu session để lưu thông tin user khi login
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    $userModel = new UserModel();
    $user = $userModel->login($username, $password);

    if ($user) {
        // Đăng nhập thành công, lưu thông tin user vào session
        $_SESSION["user"] = $user;

        // Có thể chuyển hướng sang trang home, profile hoặc dashboard
        header("Location:../index.php");
        exit;
    } else {
        echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng!'); window.history.back();</script>";
        exit;
    }
} else {
    echo "Phương thức không hợp lệ!";
}
?>
