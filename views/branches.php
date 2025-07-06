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
                    <img src="../img-index/logo.png" alt="Auto Care Logo">
                </li>
                <div class="nav-links">
                    <li><a href="home.php">Trang chủ</a></li>
                    <li><a href="branches.php">Hệ thống</a></li>
                    <li><a href="booking.php">Đặt lịch</a></li>
                    <li><a href="orders.php">Đơn hàng</a></li>
                    <li><a href="services.php">Dịch vụ đã đặt</a></li>
                </div>

                <li class="login">
                    <a href="views/login.php">Đăng nhập</a>
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
                <p><i class="fas fa-map-marker-alt"></i> chưa có</p>
                <p><i class="fas fa-envelope"></i> chưa có</p>
                <p><i class="fas fa-phone"></i> chưa có</p>
            </div>
            <div class="footer-social">
                <h3>Theo Dõi</h3>
                <a href="#"><img src="" alt="Facebook"></a>
                <a href="#"><img src="" alt="Instagram"></a>
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
        <a href="#" class="call-button">
            <i class="fas fa-phone"></i> Gọi Ngay
        </a>
        <a href="#" class="zalo-button">
            <img src="img/zalo-icon.png" alt="Zalo"> Zalo Chat
        </a>
    </div>
</body>
</html>