<?php require_once __DIR__ . '/../models/ProcessGetUserInfo.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Người Dùng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>
<body>

<div class="container">
  <div class="profile-img">
    <img src="../assets/images/Avatar-mac-dinh.png" alt="Avatar">
  </div>

  <!-- Hiển thị tên, email, phone lấy từ database -->
  <h2 id="name"><?= htmlspecialchars($user['full_name']) ?></h2>
  <p><i class="fas fa-envelope"></i> <span id="email"><?= htmlspecialchars($user['email']) ?></span></p>
  <p><i class="fas fa-phone"></i> <span id="phone"><?= htmlspecialchars($user['phone']) ?></span></p>

  <button id="editBtn"><i class="fas fa-edit"></i> Chỉnh sửa hồ sơ</button>

  <br><br>
  <a href="home.php" class="back-btn" id="backBtn"><i class="fas fa-home"></i> Về Trang Chủ</a>
</div>

<script>
const btn = document.getElementById('editBtn');
const backBtn = document.getElementById('backBtn');
let editing = false;

btn.addEventListener('click', () => {
  if (!editing) {
    enableEdit();
  } else {
    saveEdit();
  }
});

function enableEdit() {
  editing = true;
  btn.innerHTML = '<i class="fas fa-save"></i> Lưu hồ sơ';
  backBtn.style.display = 'none';

  replaceWithInput('name');
  replaceWithInput('email');
  replaceWithInput('phone');

  // Thêm 2 input mật khẩu mới vào trước nút Lưu
  const container = document.querySelector('.container');
  const newPassword = document.createElement('input');
  newPassword.type = 'password';
  newPassword.id = 'new-password';
  newPassword.placeholder = 'Mật khẩu mới';
  newPassword.style.marginTop = '10px';
  newPassword.style.display = 'block';

  const confirmPassword = document.createElement('input');
  confirmPassword.type = 'password';
  confirmPassword.id = 'confirm-password';
  confirmPassword.placeholder = 'Xác nhận mật khẩu mới';
  confirmPassword.style.marginTop = '10px';
  confirmPassword.style.display = 'block';

  // Thêm vào ngay trước nút Lưu hồ sơ
  container.insertBefore(confirmPassword, btn);
  container.insertBefore(newPassword, confirmPassword);
}

function saveEdit() {
  const newPassword = document.getElementById('new-password');
  const confirmPassword = document.getElementById('confirm-password');

  if (newPassword && confirmPassword) {
    if (newPassword.value !== confirmPassword.value) {
      alert('Mật khẩu xác nhận không khớp!');
      return;
    }

    if (newPassword.value.trim() !== "") {
      console.log('Mật khẩu mới:', newPassword.value);
      // Gửi mật khẩu mới lên server tại đây nếu cần
    }
  }

  editing = false;
  btn.innerHTML = '<i class="fas fa-edit"></i> Chỉnh sửa hồ sơ';
  backBtn.style.display = 'inline-block';

  saveInput('name');
  saveInput('email');
  saveInput('phone');

  if (newPassword) newPassword.remove();
  if (confirmPassword) confirmPassword.remove();
}

function replaceWithInput(id) {
  const el = document.getElementById(id);
  const val = el.textContent;
  el.innerHTML = `<input type="text" id="${id}-input" value="${val}">`;
}

function saveInput(id) {
  const input = document.getElementById(`${id}-input`);
  if (input) {
    document.getElementById(id).textContent = input.value;
  }
}
</script>

</body>
</html>