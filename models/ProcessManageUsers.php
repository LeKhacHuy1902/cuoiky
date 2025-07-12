<?php
require_once __DIR__ . '/../models/AdminModel.php';
session_start();

// Kiểm tra quyền admin
if (!isset($_SESSION["admin"])) {
    header("Location: ../index.php");
    exit;
}

$adminModel = new AdminModel();

// Nếu bấm nút xóa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $userId = (int)$_POST['delete_id'];
    $adminModel->deleteUser($userId);
    // Sau khi xóa thì redirect lại chính trang quản lý để load lại danh sách
    header("Location: manage-users.php");
    exit;
}

// Lấy danh sách tất cả user
$users = $adminModel->getAllUsers();
