<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/UserModel.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION["user"])) {
    header("Location: ../views/login.php");
    exit;
}

// Lấy ID từ session
$userId = $_SESSION["user"]["id"];

// Tạo đối tượng UserModel
$userModel = new UserModel();

// Lấy thông tin từ DB
$user = $userModel->getUserById($userId);

if (!$user) {
    echo "<script>
            alert('Không tìm thấy thông tin người dùng!');
            window.location.href = '../index.php';
          </script>";
    exit;
}

// Chỉ giữ lại các trường cần thiết
$user = [
    'full_name' => $user['full_name'],
    'phone'     => $user['phone'],
    'email'     => $user['email'],
];
?>