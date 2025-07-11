<?php

require_once '../models/UserModel.php';

$userModel = new UserModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $fullname = trim($_POST['fullname'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');

    // Kiểm tra dữ liệu đầu vào
    $errors = [];

    if (empty($username) || strlen($username) < 4) {
        $errors[] = "Tên đăng nhập phải ít nhất 4 ký tự.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không hợp lệ.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Mật khẩu phải ít nhất 6 ký tự.";
    }

    if (empty($fullname)) {
        $errors[] = "Vui lòng nhập họ tên.";
    }

    if (!preg_match('/^[0-9]{9,11}$/', $phone)) {
        $errors[] = "Số điện thoại không hợp lệ.";
    }

    if (empty($errors)) {
        $result = $userModel->register($username, $password, $email, $fullname, $phone);

        if ($result) {
            header("Location: login.php");
            exit;
        } else {
            $error = "Đăng ký thất bại! Có thể tên đăng nhập hoặc email đã tồn tại.";
        }
    }

    include '../views/register.php';

} else {
    include '../views/register.php';
}
