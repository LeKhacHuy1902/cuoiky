<?php


declare(strict_types=1);

require_once __DIR__ . '/database.php';  
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


function currentUser(): ?array
{
    return $_SESSION['user'] ?? null;
}


function requireLogin(): void
{
    if (!currentUser()) {
        header('Location: /views/login.php');
        exit;
    }
}


function requireAdmin(): void
{
    requireLogin();
    if (currentUser()['role'] !== 'admin') {
        header('Location: /index.php?error=403');
        exit;
    }
}


function attemptLogin(string $email, string $password): bool
{
    global $pdo;                          

    $sql  = 'SELECT id, full_name, email, password_hash, role
             FROM users WHERE email = :email LIMIT 1';
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

function logout(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $p['path'], $p['domain'], $p['secure'], $p['httponly']
        );
    }
    session_destroy();
}
function checkLogin(): void
{
    requireLogin();          
}

function isAdmin(): bool
{
    return currentUser()['role'] === 'admin';
}
