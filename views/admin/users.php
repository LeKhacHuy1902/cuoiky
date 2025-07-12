<?php
require_once __DIR__ . '/../../models/AdminModel.php';
$adminModel = new AdminModel();
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search) {
    $users = $adminModel->getUsersByUsername($search);
} else {
    $users = $adminModel->getAllUsers();
}


// Xử lý xóa user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $adminModel->deleteUser(intval($_POST['delete_id']));
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Lấy danh sách user role = 'user'
$users = $adminModel->getAllUsers();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quản Lý Người Dùng</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #1b1b1b, #333, #555);
    color: #fff;
    margin: 0;
    padding: 20px;
    min-height: 100vh;
}
.manage-users {
    max-width: 1000px;
    margin: auto;
    background: linear-gradient(135deg, #1b1b1b, #333, #555);
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.5);
}
h1 {
    color: #ffa500;
    text-align: center;
    margin-bottom: 20px;
    font-size: 2em;
}
.back-btn {
    display: inline-block;
    margin-bottom: 20px;
    background: #ffa500;
    color: #000;
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 5px;
    font-weight: bold;
    transition: background 0.3s ease;
}
.back-btn:hover {
    background: #ff8000;
}
.search-bar {
    text-align: right;
    margin: 20px 0;
}
.search-bar input {
    padding: 10px 15px;
    border-radius: 25px;
    border: none;
    outline: none;
    width: 300px;
    max-width: 90%;
    background: #fff;
    color: #000;
    font-size: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 0 5px rgba(0,0,0,0.3);
}
.search-bar input:focus {
    box-shadow: 0 0 8px #ffa500;
    transform: scale(1.02);
}
table {
    width: 100%;
    border-collapse: collapse;
    margin: auto;
    margin-bottom: 20px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    overflow: hidden;
}
table th, table td {
    border: 1px solid #444;
    padding: 12px 15px;
    text-align: left;
}
table td:last-child {
    text-align: center;
}
table th {
    background: #222;
    color: #ffa500;
    font-size: 1.1em;
}
table tr:nth-child(even) {
    background: rgba(255, 255, 255, 0.05);
}
button {
    background: #ffa500;
    color: #000;
    border: none;
    padding: 7px 15px;
    cursor: pointer;
    border-radius: 5px;
    transition: all 0.3s ease;
    font-weight: bold;
}
button:hover {
    background: #ff8000;
    transform: scale(1.05);
}
</style>
</head>
<body>

<div class="manage-users">
<header>
  <h1>Quản Lý Người Dùng</h1>
  <a href="dashboard.php" class="back-btn">← Quay lại</a>
</header>

<div class="search-bar">
  <input type="text" id="searchInput" placeholder="Tìm kiếm theo tên hoặc username...">
</div>

<table>
<thead>
  <tr>
    <th>ID</th>
    <th>Username</th>
    <th>Tên</th>
    <th>Email</th>
    <th>Số Điện Thoại</th>
    <th>Hành Động</th>
  </tr>
</thead>
<tbody id="userTable">
<?php 
foreach ($users as $user) {
    echo "<tr>
            <td>{$user['id']}</td>
            <td>{$user['username']}</td>
            <td>{$user['full_name']}</td>
            <td>{$user['email']}</td>
            <td>{$user['phone']}</td>
            <td>
              <form method='POST' onsubmit='return confirm(\"Bạn có chắc muốn xóa người dùng này?\");'>
                <input type='hidden' name='delete_id' value='{$user['id']}'>
                <button type='submit'>Xóa</button>
              </form>
            </td>
          </tr>";
}
?>
</tbody>
</table>
</div>

<script>
const searchInput = document.getElementById("searchInput");
searchInput.addEventListener("input", function() {
  const filter = searchInput.value.toLowerCase();
  const rows = document.querySelectorAll("#userTable tr");
  rows.forEach(row => {
    const username = row.cells[1].textContent.toLowerCase();
    const name = row.cells[2].textContent.toLowerCase();
    row.style.display = username.includes(filter) || name.includes(filter) ? "" : "none";
  });
});
</script>

</body>
</html>
