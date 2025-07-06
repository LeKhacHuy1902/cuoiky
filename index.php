<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Care - Trang Chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/index.css"> 
</head>
<body>
    <header>
        <div class="container">
            <ul>
                <li><img src="img-index/logo.png" alt="Auto Care Logo"></li>
                <li><a href="views/home.php">Trang chủ</a></li>
                <li><a href="views/login.php">Đăng nhập</a></li>
                <li><a href="views/booking.php">Đặt lịch</a></li>
                <li><a href="views/orders.php">Đơn hàng</a></li>
                <li><a href="views/admin/dashboard.php">Dashboard</a></li>
                <li><a href="views/admin/services.php">Dịch vụ</a></li>
                <li><a href="views/admin/users.php">Người dùng</a></li>
            </ul>
        </div>
    </header>

    <main>
        <section class="banner">
            <div class="container">
                <h1>Chào mừng đến với Auto Care</h1>
                <p>Nơi những chiếc xe mơ ước của bạn trở thành hiện thực.</p>
                <a href="views/booking.php" class="btn">Đặt lịch ngay</a>
            </div>
        </section>

        <section class="features">
            <div class="container">
                <h2>Tại sao chọn chúng tôi?</h2>
                <div class="feature-grid">
                    <div class="feature-item">
                        <i class="fas fa-car"></i>
                        <h3>Đa dạng xe</h3>
                        <p>Chúng tôi cung cấp một bộ sưu tập xe hơi phong phú, từ xe thể thao đến xe gia đình.</p>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-tools"></i>
                        <h3>Dịch vụ chuyên nghiệp</h3>
                        <p>Đội ngũ kỹ thuật viên lành nghề đảm bảo xe của bạn luôn trong tình trạng tốt nhất.</p>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <h3>An toàn tuyệt đối</h3>
                        <p>Sự an toàn của bạn là ưu tiên hàng đầu của chúng tôi với các quy trình kiểm tra nghiêm ngặt.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonials">
            <div class="container">
                <h2>Khách hàng nói gì về chúng tôi</h2>
                <div class="testimonial-item">
                    <p>"Auto Care đã mang đến cho tôi trải nghiệm tuyệt vời. Xe rất chất lượng và dịch vụ hoàn hảo!"</p>
                    <h4>- Nguyễn Văn A</h4>
                </div>
                <div class="testimonial-item">
                    <p>"Tôi rất hài lòng với sự chuyên nghiệp và tận tâm của đội ngũ Auto Care. Sẽ quay lại lần nữa!"</p>
                    <h4>- Trần Thị B</h4>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Auto Care. All rights reserved.</p>
            <p>
                <a href="#">Chính sách bảo mật</a> |
                <a href="#">Điều khoản dịch vụ</a>
            </p>
        </div>
    </footer>

    <div class="floating-buttons">
        <a href="tel:+84123456789" class="call-button">
            <i class="fas fa-phone-alt"></i> Gọi ngay
        </a>
        <a href="https://zalo.me/yourzalonumber" target="_blank" class="zalo-button">
            <img src="img-index/Facebook-logo.png" alt="Zalo"> Zalo
        </a>
    </div>

</body>
</html>