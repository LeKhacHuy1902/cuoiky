<?php
require_once __DIR__ . '/../models/UserModel.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Bạn chưa đăng nhập']);
    exit;
}

$userModel = new UserModel();
$user = $userModel->getUserById($_SESSION['user_id']);

if (!$user) {
    echo json_encode(['error' => 'Không tìm thấy người dùng']);
    exit;
}

$createdAt = date('d/m/Y', strtotime($user['created_at']));

$response = [
    'full_name' => $user['full_name'] ?? 'Chưa cập nhật',
    'email' => $user['email'] ?? 'Chưa cập nhật',
    'phone' => $user['phone'] ?? 'Chưa cập nhật',
    'username' => $user['username'] ?? 'Chưa cập nhật',
    'created_at' => $createdAt,
];

echo json_encode($response);
