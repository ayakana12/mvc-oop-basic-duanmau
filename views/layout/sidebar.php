<div class="sidebar">
  <h2>PolyShop</h2>
  <ul>
    <li><a href="?act=dashboard">📊 Dashboard</a></li>
    <li><a href="?act=category">📁 Quản lí danh mục</a></li>
    <li><a href="?act=product">🛍️ Quản lí sản phẩm</a></li>
    <li><a href="?act=comment">💬 Quản lí bình luận</a></li>
    <li><a href="?act=user">👥 Quản lí tài khoản</a></li>
    <li><a href="?act=order">📦 Quản lí đơn hàng</a></li>
    <li><a href="?act=logoutadm">🚪 Thoát</a></li>
  </ul>
</div>
<div class="main-content">
  <!-- Nội dung chính sẽ được hiển thị ở đây -->
</div>
<style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Segoe UI", sans-serif;
}

body {
  display: flex;
  min-height: 100vh;
  background-color: #ecf0f1;
}

/* === SIDEBAR === */

.sidebar {
  width: 230px;
  background-color: #2c3e50;
  color: #fff;
  padding: 20px 0;
  flex-shrink: 0;
  height: 100vh;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 100;
}

.main-content {
  margin-left: 230px;
  padding: 40px;
  flex: 1;
}

.sidebar h2 {
  text-align: center;
  margin-bottom: 30px;
  color: #f1c40f;
  font-size: 24px;
}

.sidebar ul {
  list-style: none;
  padding-left: 0;
}

.sidebar ul li {
  margin: 10px 0;
}

.sidebar ul li a {
  display: block;
  padding: 12px 20px;
  color: white;
  text-decoration: none;
  transition: all 0.3s;
}

.sidebar ul li a:hover {
  background-color: #34495e;
  border-left: 5px solid #f1c40f;
  padding-left: 25px;
}

</style>
