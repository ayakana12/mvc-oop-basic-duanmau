
<div class="main-content">
    <h1>👋 Welcome Admin</h1>
    <p>Chào mừng bạn đến trang quản trị TechZone. Hãy chọn chức năng ở menu bên trái để bắt đầu.</p>
  </div>
<style>
/* Reset cơ bản */
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


/* === MAIN CONTENT === */
.main-content {
  flex: 1;
  padding: 40px;
  margin-left: 230px; /* Để tránh bị sidebar che, đồng bộ với sidebar */
}

.main-content h1 {
  font-size: 32px;
  margin-bottom: 20px;
  color: #2c3e50;
}

.main-content p {
  font-size: 18px;
  color: #555;
}

/* Optional: Responsive */
@media (max-width: 768px) {
  body {
    flex-direction: column;
  }

  .sidebar {
    width: 100%;
    text-align: center;
  }

  .sidebar ul li a {
    display: inline-block;
    margin: 5px;
  }

  .main-content {
    padding: 20px;
  }
}


</style>