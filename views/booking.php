<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lịch - Rửa Xe Thể Thao</title>
    <link rel="stylesheet" href="../assets/css/booking.css">
</head>
<body>
    <div class="booking-container">
        <div class="booking-banner">
            <h1>Đặt Lịch Dễ Dàng</h1>
            <p>Đưa xe của bạn đến dịch vụ chăm sóc tốt nhất!</p>
        </div>
        <div class="booking-form">
            <h2>Đặt Lịch Rửa Xe</h2>
            <form action="process_booking.php" method="POST">
                <input type="text" name="name" placeholder="Họ và Tên" required>
                <input type="tel" name="phone" placeholder="Số Điện Thoại" required>
                <input type="email" name="email" placeholder="Email" required>
                <select name="service" required>
                    <option value="" disabled selected>Chọn Dịch Vụ</option>
                    <option value="basic">Rửa Xe Cơ Bản</option>
                    <option value="interior">Vệ Sinh Nội Thất</option>
                    <option value="engine">Vệ Sinh Khoang Động Cơ</option>
                    <option value="premium">Bảo Dưỡng Cao Cấp</option>
                </select>
                <input type="date" name="date" required>
                <textarea name="notes" placeholder="Ghi Chú Thêm (Nếu Có)"></textarea>
                <button type="submit" class="booking-btn">Đặt Lịch Ngay</button>
            </form>
        </div>
    </div>
</body>
</html>
