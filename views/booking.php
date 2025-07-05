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
                <!-- ĐÂY LÀ CODE MẪU ĐỂ LÀM PHẦN CHỌN NHIỀU DỊCH VỤ -->
                <select id="services" multiple>
                    <option value="1" data-price="100000">Rửa Xe Cơ Bản - 100,000₫</option>
                    <option value="2" data-price="200000">Vệ Sinh Nội Thất - 200,000₫</option>
                    <option value="3" data-price="300000">Vệ Sinh Khoang Động Cơ - 300,000₫</option>
                    <option value="4" data-price="500000">Bảo Dưỡng Cao Cấp - 500,000₫</option>
                </select>
                <!-- ĐÂY LÀ CODE MẪU TÍNH TỔNG TIỀN -->
                <p>Tổng tiền: <span id="total">0</span> ₫</p>

                <textarea name="notes" placeholder="Ghi Chú Thêm (Nếu Có)"></textarea>
                <button type="submit" class="booking-btn">Đặt Lịch Ngay</button>
            </form>
        </div>
    </div>
</body>
</html>
