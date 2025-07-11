<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Auto moto care</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/branche.css">
</head>

<body>
  <!-- Header -->
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
            <?php 
              if (isset($_SESSION["user"])) {
                echo htmlspecialchars($_SESSION["user"]["full_name"]);
              } else {
                echo "Người dùng";
            }
            ?>
          </span>
        </div>
            <div class="dropdown" id="profile-dropdown">
                <ul>
                    <li><a href="profile.php">Hồ sơ</a></li>
                    <li><a href="../index.php">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
      </li>
      </ul>
    </div>
  </header>

  <!-- chuôi cửa hàng -->
  <h1 class="branches-title">Chuỗi Hệ Thống Trung Tâm</h1>

  <div class="branches">
    <div class="branch">
      <div class="branch-image">
        <img src="../img-index/cuahang1.png" alt="Logo">
      </div>
      <div class="branch-info">
        <h2>Trung Tâm Quận 1, TP HCM</h2>
        <p><i class="fas fa-map-marker-alt"></i> 123 Lê Lợi, Quận 1</p>
        <p><i class="fas fa-phone"></i> 0123 456 789</p>
      </div>
    </div>

    <div class="branch">
      <div class="branch-image">
        <img src="../img-index/cuahang2.png" alt="Logo">
      </div>
      <div class="branch-info">
        <h2>Trung Tâm Quận 3, TP HCM</h2>
        <p><i class="fas fa-map-marker-alt"></i> 456 Nguyễn Đình Chiểu, Quận 3</p>
        <p><i class="fas fa-phone"></i> 0987 654 321</p>
      </div>
    </div>

    <div class="branch">
      <div class="branch-image">
        <img src="../img-index/cuahang3.png" alt="Logo">
      </div>
      <div class="branch-info">
        <h2>Trung Tâm Quận 7, TP HCM</h2>
        <p><i class="fas fa-map-marker-alt"></i> 789 Phú Mỹ Hưng, Quận 7</p>
        <p><i class="fas fa-phone"></i> 0345 678 910</p>
      </div>
    </div>
  </div>

   <!-- Footer -->
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
                <img src="../assets/images/Facebook-logo.png" alt="Facebook">
            </a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
                <img src="../assets/images/Instagram-logo.png" alt="Instagram">
            </a>
        </div>
     </div>
     <section>
        &copy; 2025 <a href="https://lekhachuy1902.github.io/Digital-CV/">Car Wash & Repair Admin . Mọi quyền được bảo lưu.</a>
    </section>
    </footer>

    <!-- Nút liên hệ -->
    <div class="floating-buttons">
      <a href="tel:0835552953" class="call-button">
        <i class="fas fa-phone"></i> Gọi Ngay
      </a>
      <a href="https://zalo.me/0835552953" class="zalo-button" target="_blank" rel="noopener noreferrer">
        <img src="../assets/images/zalo-logo.png" alt="Zalo"> Zalo Chat
      </a>
    </div>
    <!-- event hồ sơ -->
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