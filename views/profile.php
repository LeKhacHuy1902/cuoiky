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

  <h2 id="name">Nguyễn Văn A</h2>
  <p><i class="fas fa-envelope"></i> <span id="email">nguyenvana@example.com</span></p>
  <p><i class="fas fa-phone"></i> <span id="phone">0123 456 789</span></p>

  <button id="editBtn"><i class="fas fa-edit"></i> Chỉnh sửa hồ sơ</button>

  <br><br>
  <a href="../index.php" class="back-btn" id="backBtn"><i class="fas fa-home"></i> Về Trang Chủ</a>
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
}

function saveEdit() {
  editing = false;
  btn.innerHTML = '<i class="fas fa-edit"></i> Chỉnh sửa hồ sơ';
  backBtn.style.display = 'inline-block';

  saveInput('name');
  saveInput('email');
  saveInput('phone');
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
