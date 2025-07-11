<?php
if (!isset($_SESSION)) {
    session_start();
}

// Import model
require_once __DIR__ . '/../models/BookingModel.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    exit;
}

$bookingModel = new BookingModel();
$userId = $_SESSION["user"]["id"];

// Nếu bấm nút hủy
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
    $bookingId = (int)$_POST['booking_id'];

    // Update trạng thái đơn hàng sang "ĐÃ HỦY"
    $stmt = $bookingModel->conn->prepare("UPDATE bookings SET status = 'ĐÃ HỦY' WHERE id = :id AND user_id = :user_id");
    $stmt->bindParam(":id", $bookingId, PDO::PARAM_INT);
    $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
    $stmt->execute();

    // Refresh lại dữ liệu
    header("Location: dich-vu-da-dat.php");
    exit;
}

$bookings = $bookingModel->getUserBookings($userId);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dịch Vụ Đã Đặt</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/dich-vu-da-dat.css">
</head>
<body>

<header>
    <div class="container">
        <ul class="nav">
            <li class="logo">
                <img src="../assets/images/logo.png" alt="Auto Care Logo">
            </li>
            <div class="nav-links">
                <li><a href="home.php">Trang chủ</a></li>
                <li><a href="branches.php">Hệ thống</a></li>
                <li><a href="booking.php">Đặt lịch</a></li>
                <li><a href="dich-vu-da-dat.php">Dịch vụ đã đặt</a></li>
            </div>
            <li class="user-profile">
                <div class="profile" id="profile-btn">
                    <img src="../assets/images/Avatar-mac-dinh.png" alt="User Avatar">
                    <span class="username">
                        <?= isset($_SESSION["user"]) ? htmlspecialchars($_SESSION["user"]["full_name"]) : "Người dùng"; ?>
                    </span>
                </div>
                <div class="dropdown" id="profile-dropdown">
                    <ul>
                        <li><a href="profile.php">Hồ sơ</a></li>
                        <li><a href="../index.php">Đăng xuất</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</header>

<div class="container">
    <h1>Dịch Vụ Đã Đặt</h1>

    <div class="service-list">
        <?php if (empty($bookings)): ?>
            <div class="empty-message">Bạn chưa đặt dịch vụ nào.</div>
        <?php else: ?>
            <?php foreach ($bookings as $booking): ?>
                <div class="service">
                    <div class="service-info">
                        <h2><?= htmlspecialchars($booking['address']) ?></h2>
                        <p><i class="fas fa-user"></i> Người đặt: <?= htmlspecialchars($booking['full_name']) ?></p>
                        <p><i class="fas fa-calendar-alt"></i> Ngày: <?= htmlspecialchars(date('d/m/Y', strtotime($booking['bookings_date']))) ?></p>
                        <p><i class="fas fa-phone"></i> SĐT: <?= htmlspecialchars($booking['phone']) ?></p>
                        <p><i class="fas fa-money-bill"></i> Tổng tiền: <?= number_format($booking['total_price'], 0, ',', '.') ?> đ</p>
                        <p><i class="fas fa-clipboard"></i> Ghi chú: <?= htmlspecialchars($booking['note'] ?? 'Không có') ?></p>
                        <p><i class="fas fa-info-circle"></i> Trạng thái: <?= htmlspecialchars($booking['status']) ?></p>

                        <!-- Nút hủy -->
                        <?php if ($booking['status'] !== 'ĐÃ HỦY'): ?>
                            <form method="POST" onsubmit="return confirm('Bạn chắc chắn muốn hủy đơn này?');">
                                <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['id']) ?>">
                                <button type="submit" class="cancel-btn">Hủy đơn</button>
                            </form>
                        <?php else: ?>
                            <p style="color: red; font-weight: bold;">Đơn đã hủy</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<footer>
    <div class="container footer-container">
        <div class="footer-info">
             <h3>Liên Hệ</h3>
            <p><i class="fas fa-map-marker-alt"></i> 123 Lê Lợi, Quận 1</p>
            <p><i class="fas fa-envelope"></i> contact@example.com</p>
            <p><i class="fas fa-phone"></i> 0835552953</p>
        </div>
        <div class="footer-social">
            <h3>Theo Dõi</h3>
            <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/images/Facebook-logo.png" alt="Facebook">
            </a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
                <img src="assets/images/Instagram-logo.png" alt="Instagram">
            </a>
        </div>
    </div>
</footer>

<div class="floating-buttons">
  <a href="tel:0835552953" class="call-button">
    <i class="fas fa-phone"></i> Gọi Ngay
  </a>
  <a href="https://zalo.me/0835552953" class="zalo-button" target="_blank" rel="noopener noreferrer">
    <img src="../assets/images/zalo-logo.png" alt="Zalo"> Zalo Chat
  </a>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("profile-btn");
    const dropdown = document.getElementById("profile-dropdown");

    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    });

    document.addEventListener("click", () => {
        dropdown.style.display = "none";
    });
});
</script>
</body>
</html>
