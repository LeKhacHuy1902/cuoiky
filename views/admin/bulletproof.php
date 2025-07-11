<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thống Kê & Báo Cáo</title>
<link rel="stylesheet" href="../../assets/css/bulletproof.css">
</head>
<body>
<div class="report-page">
    <header>
        <h1>Thống Kê & Báo Cáo</h1>
        <a href="dashboard.php" class="back-btn">← Quay lại Dashboard</a>
    </header>

    <div class="filter">
        <button class="filter-btn" onclick="setFilter('day')">Ngày</button>
        <button class="filter-btn" onclick="setFilter('week')">Tuần</button>
        <button class="filter-btn" onclick="setFilter('month')">Tháng</button>
        <button class="filter-btn" onclick="setFilter('year')">Năm</button>
    </div>

    <div class="stats" id="stats">
        <!-- thống kê sẽ được cập nhật -->
    </div>
</div>

<script>
const statsEl = document.getElementById('stats');
const data = {
    day: {
        users: 0, services: 0, orders: 0, revenue: null
    },
    week: {
        users: 0, services: 0, orders: 0, revenue: null
    },
    month: {
        users: 0, services: 0, orders: 0, revenue: null
    },
    year: {
        users: 0, services: 0, orders: 0, revenue: null
    }
};

function setFilter(period) {
    const d = data[period];
    statsEl.innerHTML = `
        <div class="stat-card"><h2>Người Dùng</h2><p>${d.users}</p></div>
        <div class="stat-card"><h2>Dịch Vụ</h2><p>${d.services}</p></div>
        <div class="stat-card"><h2>Đơn Hàng</h2><p>${d.orders}</p></div>
        <div class="stat-card"><h2>Doanh Thu</h2><p>${d.revenue}</p></div>
    `;
}

// mặc định là theo ngày
setFilter('day');
</script>
</body>
</html>
