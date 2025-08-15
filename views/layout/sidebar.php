<div class="sidebar">
  <h2>TechZone</h2>
  <ul>
    <li><a href="?act=dashboard">📊 Dashboard</a></li>
    <li><a href="?act=category">📁 Quản lí danh mục</a></li>
    <li><a href="?act=product">🛍️ Quản lí sản phẩm</a></li>
    <li><a href="?act=comment">💬 Quản lí bình luận</a></li>
    <li><a href="?act=user">👥 Quản lí tài khoản</a></li>
    <li><a href="?act=logoutadm">🚪 Thoát</a></li>
  </ul>
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
  background-color: inherit;
  border-left: none;
  padding-left: 20px;
}

.sidebar ul li a.active {
  background-color: inherit;
  border-left: none;
  padding-left: 20px;
}
.sidebar ul li a,
.sidebar ul li a:active,
.sidebar ul li a:focus {
  background: inherit !important;
  border: none !important;
  outline: none !important;
  box-shadow: none !important;
  color: white;
  padding-left: 20px;
}

</style>
