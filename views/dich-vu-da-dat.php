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

<div class="container">
  <h1>Dịch Vụ Đã Đặt</h1>

  <div class="service-list" id="service-list">
    <!-- Dịch vụ sẽ được render ở đây -->
  </div>

  <div class="empty-message" id="empty-message" style="display: none;">
    Bạn chưa đặt dịch vụ nào.
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
            <div class="newsletter">
                <h3>Đăng Ký Nhận Tin Tức</h3>
                <form action="#">
                    <input type="email" placeholder="Nhập email của bạn">
                    <button type="submit">Đăng Ký</button>
                </form>
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
    
    <!-- test -->
    <script>
      document.addEventListener("DOMContentLoaded", () => {
  const serviceList = document.getElementById('service-list');
  const emptyMessage = document.getElementById('empty-message');

  let services = JSON.parse(localStorage.getItem("services")) || [
    { id: 1, name: "Rửa xe ô tô", date: "10/07/2025", time: "14:00", location: "Trung tâm Quận 1" },
    { id: 2, name: "Thay dầu xe máy", date: "15/07/2025", time: "10:30", location: "Trung tâm Quận 3" },
    { id: 3, name: "Vệ sinh nội thất", date: "20/07/2025", time: "16:00", location: "Trung tâm Quận 7" }
  ];

  function saveServices() {
    localStorage.setItem("services", JSON.stringify(services));
  }

  function renderServices() {
    serviceList.innerHTML = '';
    if (services.length === 0) {
      emptyMessage.style.display = 'block';
      return;
    } else {
      emptyMessage.style.display = 'none';
    }

    services.forEach(service => {
      const div = document.createElement('div');
      div.className = 'service';
      div.dataset.id = service.id;

      div.innerHTML = `
        <div class="service-info">
          <h2>${service.name}</h2>
          <p><i class="fas fa-calendar-alt"></i> Ngày: ${service.date}</p>
          <p><i class="fas fa-clock"></i> Giờ: ${service.time}</p>
          <p><i class="fas fa-map-marker-alt"></i> ${service.location}</p>
        </div>
        <button class="btn-cancel">Hủy</button>
      `;

      div.querySelector('.btn-cancel').addEventListener('click', () => {
        if (confirm(`Bạn có chắc chắn muốn hủy dịch vụ "${service.name}" không?`)) {
          removeService(service.id);
        }
      });

      serviceList.appendChild(div);
    });
  }

  function removeService(id) {
    const div = document.querySelector(`.service[data-id="${id}"]`);
    if (div) {
      div.style.transition = 'opacity 0.3s';
      div.style.opacity = 0;
      setTimeout(() => {
        services = services.filter(s => s.id !== id);
        saveServices();
        renderServices();
      }, 300);
    }
  }

  saveServices();
  renderServices();
});
// event khi nhấn vào tài khoảng
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
