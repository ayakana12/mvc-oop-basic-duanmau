<?php

?>

<div class="dashboard-container">
    <h1 style="margin-bottom: 28px;">Dashboard Quản trị</h1>
    <div class="dashboard-summary">
        <div class="dashboard-card">
            <h2>Tài khoản</h2>
            <p><?php echo $userCount ?? 0; ?> người dùng</p>
        </div>
        <div class="dashboard-card">
            <h2>Sản phẩm</h2>
            <p><?php echo $productCount ?? 0; ?> sản phẩm</p>
        </div>
        <div class="dashboard-card">
            <h2>Danh mục</h2>
            <p><?php echo $categoryCount ?? 0; ?> danh mục</p>
        </div>
        <div class="dashboard-card">
            <h2>Bình luận</h2>
            <p><?php echo $commentCount ?? 0; ?> bình luận</p>
        </div>
    </div>
    <div class="dashboard-latest">
        <h3>Người dùng mới nhất</h3>
        <div class="table-responsive">
        <table class="table dashboard-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($latestUsers)) foreach ($latestUsers as $u): ?>
                <tr>
                    <td><?php echo $u['id']; ?></td>
                    <td><?php echo htmlspecialchars($u['name']); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                    <td><?php echo htmlspecialchars($u['address'] ?? ''); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        <h3>Sản phẩm mới nhất</h3>
        <div class="table-responsive">
        <table class="table dashboard-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Danh mục</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($latestProducts)) foreach ($latestProducts as $p): ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo htmlspecialchars($p['name']); ?></td>
                    <td><?php echo number_format($p['price']); ?> đ</td>
                    <td><?php echo htmlspecialchars($p['tendanhmuc'] ?? ''); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<style>
.dashboard-container {
    max-width: 1100px;
    margin: 30px auto;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.10);
    padding: 40px 32px;
    height: calc(100vh - 40px);
    overflow-y: auto;
}
.dashboard-summary {
    display: flex;
    gap: 32px;
    margin-bottom: 36px;
    justify-content: center;
}
.dashboard-card {
    flex: 1;
    background: #f8f9fa;
    border-radius: 12px;
    padding: 22px 16px;
    text-align: center;
    box-shadow: 0 1px 8px #0001;
    transition: box-shadow 0.2s;
}
.dashboard-card:hover {
    box-shadow: 0 4px 16px #b4332c33;
}
.dashboard-card h2 {
    color: #b4332c;
    font-size: 1.2rem;
    margin-bottom: 8px;
    font-weight: 600;
}
.dashboard-card p {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    margin: 0;
}
.dashboard-latest {
    margin-top: 24px;
}
.dashboard-latest h3 {
    color: #b4332c;
    margin-top: 18px;
    font-size: 1.1rem;
    font-weight: 600;
}
.table-responsive {
    width: 100%;
    overflow-x: auto;
    margin-bottom: 18px;
}
.dashboard-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 6px #0001;
}
.dashboard-table th, .dashboard-table td {
    padding: 12px 10px;
    border-bottom: 1px solid #eee;
    text-align: left;
    font-size: 1rem;
}
.dashboard-table th {
    background: #b4332c;
    color: #fff;
    font-weight: 600;
    border: none;
}
.dashboard-table tr:last-child td {
    border-bottom: none;
}
.dashboard-table tr {
    transition: background 0.2s;
}
.dashboard-table tbody tr:hover {
    background: #f8dedd;
}
</style>
