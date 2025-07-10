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

    <script>
    const servicesSelect = document.getElementById('services');
    const totalSpan = document.getElementById('total');

    servicesSelect.addEventListener('change', () => {
        let total = 0;
        Array.from(servicesSelect.selectedOptions).forEach(option => {
            total += parseInt(option.dataset.price);
        });
        totalSpan.textContent = total.toLocaleString();
    });
    </script>
</body>
</html>
