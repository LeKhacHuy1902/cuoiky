<?php

declare(strict_types=1);

// Không cần gọi session_start() vì đã trong auth.php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../models/AdminModel.php';

// Chỉ cho phép admin truy cập
requireAdmin();

$adminModel = new AdminModel();

$users    = $adminModel->getAllUsers();
$services = $adminModel->getAllServices();

include __DIR__ . '/../views/admin/dashboard.php';
