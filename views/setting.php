<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cài Đặt Tài Khoản</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background: linear-gradient(135deg, #1b1b1b, #333, #555);
  color: #fff;
}
.container {
  max-width: 700px;
  margin: 50px auto;
  background: rgba(0, 0, 0, 0.6);
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 0 15px rgba(0,0,0,0.5);
}
h2 {
  color: #ffd700;
  text-align: center;
  margin-bottom: 30px;
}
.section {
  margin-bottom: 30px;
}
.section h3 {
  color: #ffd700;
  margin-bottom: 15px;
  border-left: 4px solid #ffd700;
  padding-left: 10px;
  font-size: 18px;
}
.form-group {
  margin-bottom: 15px;
}
label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}
input, select {
  width: 100%;
  padding: 10px;
  border: 1px solid #555;
  border-radius: 4px;
  font-size: 14px;
  background: #222;
  color: #fff;
}
input:focus, select:focus {
  border-color: #ffd700;
  outline: none;
  box-shadow: 0 0 4px #ffd700;
}
button {
  background-color: #ffd700;
  color: white;
  padding: 12px 25px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 15px;
  display: block;
  margin: 0 auto;
}
button:hover {
  background-color: #ffd700;
}
</style>
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

    <div class="section">
      <h3><i class="fas fa-bell"></i> Thông Báo</h3>

      <div class="form-group">
        <label for="notifications">Nhận thông báo qua email?</label>
        <select id="notifications" name="notifications">
          <option value="yes">Có</option>
          <option value="no">Không</option>
        </select>
      </div>
    </div>

    <button type="submit"><i class="fas fa-save"></i> Lưu Cài Đặt</button>
  </form>
</div>

</body>
</html>
