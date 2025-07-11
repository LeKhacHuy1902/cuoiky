<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cài Đặt Tài Khoản</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="../assets/css/setting.css">
</head>
<body>

<div class="container">
  <h2><i class="fas fa-cogs"></i> Cài Đặt Tài Khoản</h2>

  <form>
    <div class="section">
      <h3><i class="fas fa-user"></i> Thông Tin Cá Nhân</h3>

      <div class="form-group">
        <label for="name">Tên:</label>
        <input type="text" id="name" name="name" placeholder="Nhập tên của bạn" value="Nguyễn Văn A">
      </div>

      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="email@example.com" value="nguyenvana@example.com">
      </div>

      <div class="form-group">
        <label for="phone">Số Điện Thoại:</label>
        <input type="text" id="phone" name="phone" placeholder="0123 456 789" value="0123 456 789">
      </div>
    </div>

    <div class="section">
      <h3><i class="fas fa-lock"></i> Đổi Mật Khẩu</h3>

      <div class="form-group">
        <label for="current-password">Mật Khẩu Hiện Tại:</label>
        <input type="password" id="current-password" name="current-password">
      </div>

      <div class="form-group">
        <label for="new-password">Mật Khẩu Mới:</label>
        <input type="password" id="new-password" name="new-password">
      </div>

      <div class="form-group">
        <label for="confirm-password">Xác Nhận Mật Khẩu Mới:</label>
        <input type="password" id="confirm-password" name="confirm-password">
      </div>
    </div>

    <button type="submit"><i class="fas fa-save"></i> Lưu Cài Đặt</button>
  </form>
</div>

</body>
</html>
