<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hồ Sơ Người Dùng</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: linear-gradient(135deg, #1b1b1b, #333, #555);
  color: #fff;
}
.container {
  max-width: 800px;
  margin: 50px auto;
  background: rgba(0,0,0,0.6);
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 0 15px rgba(0,0,0,0.5);
  text-align: center;
}
.profile-img {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto 20px;
  border: 4px solid #ffd700;
}
.profile-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
h2 {
  color:#ffd700;
  margin-bottom: 5px;
}
p {
  margin: 5px 0;
  font-size: 16px;
}
.info {
  text-align: left;
  margin-top: 30px;
}
.info h3 {
  border-left: 4px solid #ffd700;
  padding-left: 10px;
  color: #ffd700;
  margin-bottom: 15px;
}
.info-item {
  margin-bottom: 10px;
}
.info-item strong {
  display: inline-block;
  width: 120px;
}
button {
  margin-top: 20px;
  background-color: #ffd700;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
button:hover {
  background-color:rgb(136, 120, 30);
}
</style>
</head>
<body>

<div class="container">
  <div class="profile-img">
    <img src="../img-index/user-avatar.png" alt="Avatar">
  </div>

  <h2>Nguyễn Văn A</h2>
  <p><i class="fas fa-envelope"></i> nguyenvana@example.com</p>
  <p><i class="fas fa-phone"></i> 0123 456 789</p>

  <div class="info">
    <h3><i class="fas fa-info-circle"></i> Thông Tin Chi Tiết</h3>
    <div class="info-item">
      <strong>Địa chỉ:</strong> 123 Đường ABC, Quận 1, TP HCM
    </div>
    <div class="info-item">
      <strong>Ngày sinh:</strong> 01/01/1990
    </div>
    <div class="info-item">
      <strong>Tham gia:</strong> 10/05/2024
    </div>
  </div>

  <button><i class="fas fa-edit"></i> Chỉnh sửa hồ sơ</button>
</div>

</body>
</html>
