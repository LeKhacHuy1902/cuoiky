<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hồ Sơ Người Dùng</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
body {
  font-family: Arial, sans-serif;
  background: #f5f5f5;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
}
.container {
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
  max-width: 400px;
  width: 90%;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}
.profile-img img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  margin-bottom: 10px;
}
.info {
  text-align: left;
  margin-top: 20px;
}
.info-item {
  margin-bottom: 15px;
}
button {
  background: #007BFF;
  color: #fff;
  border: none;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
}
button:hover {
  background: #0056b3;
}
input {
  width: 100%;
  padding: 5px;
  margin-top: 3px;
  border: 1px solid #ccc;
  border-radius: 4px;
}
</style>
</head>
<body>

<div class="container">
  <div class="profile-img">
    <img src="../img-index/user-avatar.png" alt="Avatar">
  </div>

  <h2 id="name">Nguyễn Văn A</h2>
  <p><i class="fas fa-envelope"></i> <span id="email">nguyenvana@example.com</span></p>
  <p><i class="fas fa-phone"></i> <span id="phone">0123 456 789</span></p>

  <button id="editBtn"><i class="fas fa-edit"></i> Chỉnh sửa hồ sơ</button>
</div>

<script>
const btn = document.getElementById('editBtn');
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

  replaceWithInput('name');
  replaceWithInput('email');
  replaceWithInput('phone');
}

function saveEdit() {
  editing = false;
  btn.innerHTML = '<i class="fas fa-edit"></i> Chỉnh sửa hồ sơ';

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
