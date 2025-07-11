<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/UserModel.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';
    $isManager = isset($_POST["is_manager"]); // kiểm tra checkbox

    $userModel = new UserModel();
    $user = $userModel->login($username, $password);

    if ($user) {
        if ($isManager) {
            // Nếu tick quản lí, kiểm tra role
            if ($user["role"] === "admin") {
                $_SESSION["user"] = $user;
                header("Location: ../views/admin/dashboard.php");
                exit;
            } else {
                echo "<script>alert('Bạn không có quyền quản lí!'); window.history.back();</script>";
                exit;
            }
        } else {
            // Không phải quản lí => login bình thường
            $_SESSION["user"] = $user;
            header("Location: ../views/home.php");
            exit;
        }
    } else {
        echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng!'); window.history.back();</script>";
        exit;
    }
} else {
    echo "Phương thức không hợp lệ!";
}
?>