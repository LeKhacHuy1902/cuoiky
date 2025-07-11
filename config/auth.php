<?php
declare(strict_types=1);

require_once __DIR__ . '/database.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

// Lấy thông tin người dùng hiện tại
function currentUser(): ?array
{
    return $_SESSION['user'] ?? null;
}

// Kiểm tra đã đăng nhập chưa
function isLoggedIn(): bool
{
    return currentUser() !== null;
}

// Chuyển hướng nếu chưa đăng nhập
function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: /views/login.php');
        exit;
    }
}

// Chuyển hướng nếu không phải admin
function requireAdmin(): void
{
    requireLogin();
    if (!isAdmin()) {
        header('Location: /index.php?error=403');
        exit;
    }
}

// Chuyển hướng nếu không phải staff
function requireStaff(): void
{
    requireLogin();
    if (!isStaff()) {
        header('Location: /index.php?error=403');
        exit;
    }
}

// Đăng nhập
function attemptLogin(string $email, string $password): bool
{
    global $pdo;

    $sql = 'SELECT id, full_name, email, password_hash, role FROM users WHERE email = :email LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user'] = [
            'id'    => $user['id'],
            'name'  => $user['full_name'],
            'email' => $user['email'],
            'role'  => $user['role'],
        ];
        session_regenerate_id(true);
        return true;
    }

    return false;
}

// Đăng xuất
function logout(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    session_destroy();
}

// Các hàm kiểm tra vai trò
function isAdmin(): bool
{
    return currentUser()['role'] === 'admin';
}

function isStaff(): bool
{
    return currentUser()['role'] === 'staff';
}

function isDoctor(): bool
{
    return currentUser()['role'] === 'doctor';
}

function isManager(): bool
{
    return currentUser()['role'] === 'manager';
}
