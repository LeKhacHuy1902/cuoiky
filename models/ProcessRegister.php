<?php
require_once __DIR__ . '/UserModel.php';
require_once __DIR__ . '/../config/database.php';

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = trim($_POST['fullname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Kiểm tra mật khẩu khớp
    if ($password !== $confirm_password) {
        echo "<script>alert('Mật khẩu không khớp!'); window.history.back();</script>";
        exit;
    }

    $userModel = new UserModel();
    $result = $userModel->register($username, $password, $email, $phone, $full_name);

    if ($result === true) {
        echo "<script>alert('Đăng ký thành công!'); window.location.href = '../views/login.php';</script>";
        exit;
    } else {
        echo "<script>alert('$result'); window.history.back();</script>";
        exit;
    }
}
?>
