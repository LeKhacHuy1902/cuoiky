<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đặt Lịch - Rửa Xe Thể Thao</title>
  <link rel="stylesheet" href="../assets/css/booking.css">
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
            <span class="username">Nguyễn Văn A</span>
          </div>
          <div class="dropdown" id="profile-dropdown">
          </div>
        </li>
      </ul>
    </div>
  </header>


  <div class="booking-container">
    <div class="booking-banner">
      <h1>Đặt Lịch Dễ Dàng</h1>
      <p>Đưa xe của bạn đến dịch vụ chăm sóc tốt nhất!</p>
    </div>
    <div class="booking-form">
      <h2>Đặt Lịch Rửa Xe</h2>
      <form method="POST">
        <input type="text" name="name" placeholder="Họ và Tên" required>
        <input type="tel" name="phone" placeholder="Số Điện Thoại" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="address" placeholder="Địa chỉ" required>
        <input type="date" name="date" required>

        <div class="service-options">
          <p><strong>Dịch vụ:</strong></p>
          <label>
            <input type="checkbox" name="services[]" value="1" data-price="100000">
            Rửa Xe Cơ Bản - 100,000₫
          </label>
          <label>
            <input type="checkbox" name="services[]" value="2" data-price="200000">
            Vệ Sinh Nội Thất - 200,000₫
          </label>
          <label>
            <input type="checkbox" name="services[]" value="3" data-price="300000">
            Vệ Sinh Khoang Động Cơ - 300,000₫
          </label>
          <label>
            <input type="checkbox" name="services[]" value="4" data-price="500000">
            Bảo Dưỡng Cao Cấp - 500,000₫
          </label>
        </div>


        <p>Tổng tiền: <span id="total">0</span> ₫</p>

        <textarea name="notes" placeholder="Ghi Chú Thêm (Nếu Có)"></textarea>
        <button type="submit" class="booking-btn">Đặt Lịch Ngay</button>
      </form>
    </div>
  </div>


  <!-- Footer -->
  <footer>
    <div class="container footer-container">
      <div class="footer-info">
        <h3>Liên Hệ</h3>
        <p><i class="fas fa-map-marker-alt"></i> chưa có</p>
        <p><i class="fas fa-envelope"></i> chưa có</p>
        <p><i class="fas fa-phone"></i> chưa có</p>
      </div>
      <div class="footer-social">
        <h3>Theo Dõi</h3>
        <a href="#"><img src="../assets/images/Facebook-logo.png" alt="Facebook"></a>
        <a href="#"><img src="../assets/images/Instagram-logo.png" alt="Instagram"></a>
      </div>
    </div>
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