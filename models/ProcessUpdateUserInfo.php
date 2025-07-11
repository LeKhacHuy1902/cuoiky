<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/UserModel.php';

if (!isset($_SESSION["user"])) {
    header("Location: ../views/login.php");
    exit;
}

$userId = $_SESSION["user"]["id"];
$userModel = new UserModel();

$fullName = trim($_POST["full_name"] ?? "");
$email    = trim($_POST["email"] ?? "");
$phone    = trim($_POST["phone"] ?? "");
$newPass  = trim($_POST["new_password"] ?? "");

$hashedPassword = !empty($newPass) ? password_hash($newPass, PASSWORD_DEFAULT) : null;

$result = $userModel->updateProfile($userId, $fullName, $phone, $email, $hashedPassword);

if ($result === true) {
    echo "<script>alert('Cập nhật thành công!'); window.location.href = '../views/profile.php';</script>";
} else {
    echo "<script>alert('$result'); window.history.back();</script>";
}