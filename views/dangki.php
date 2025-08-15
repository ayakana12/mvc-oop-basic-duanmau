<form action="<?= BASE_URL.'?act=formdangki' ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
<div class="main-content">
    <div class="login-container">
        <h2>Đăng kí</h2>
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="name" required pattern="^[a-zA-Z0-9]{3,}$" title="Tên đăng nhập phải từ 3 ký tự trở lên, chỉ gồm chữ và số">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Email không đúng định dạng">
        </div>
          <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <input type="text" id="address" name="address" required placeholder="Nhập địa chỉ của bạn">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="pass" required minlength="6" title="Mật khẩu tối thiểu 6 ký tự">
        </div>
        <div class="form-group">
            <label for="confirm_password">Xác nhận mật khẩu:</label>
            <input type="password" id="confirm_password" name="confirm_pass" required minlength="6" title="Mật khẩu tối thiểu 6 ký tự">
        </div>
        <div class="form-group">
            <label for="avatar">Ảnh đại diện:</label>
            <input type="file" id="avatar" name="avatar" accept="image/*">
        </div>
      
        <div class="form-group">
            <button type="submit" name="login">Đăng kí</button>
        </div>
    <a href="<?= BASE_URL.'?act=/' ?>" class="btn-back">Quay lại</a>
    </div>
    </div>
</form>
</div>
<script>
function validateForm() {
    var username = document.getElementById('username').value.trim();
    var email = document.getElementById('email').value.trim();
    var password = document.getElementById('password').value;
    var confirm = document.getElementById('confirm_password').value;
    var usernamePattern = /^[a-zA-Z0-9]{3,}$/;
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!username || !email || !password || !confirm) {
        alert('Vui lòng điền đầy đủ thông tin.');
        return false;
    }
    if (!usernamePattern.test(username)) {
        alert('Tên đăng nhập phải từ 3 ký tự trở lên, chỉ gồm chữ và số.');
        return false;
    }
    if (!emailPattern.test(email)) {
        alert('Email không đúng định dạng.');
        return false;
    }
    if (password.length < 6) {
        alert('Mật khẩu tối thiểu 6 ký tự.');
        return false;
    }
    if (password !== confirm) {
        alert('Mật khẩu xác nhận không khớp.');
        return false;
    }
    return true;
}
</script>
<style>
    body {
    background: #f0f2f5;
    font-family: Arial, sans-serif;
}
.login-container {
    width: 350px;
    margin: 80px auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.12);
    padding: 32px 28px 24px 28px;
}
.login-container h2 {
    text-align: center;
    margin-bottom: 24px;
    color: #333;
}
.form-group {
    margin-bottom: 30px;
}
label {
    display: block;
    margin-bottom: 6px;
    color: #555;
    font-weight: 500;
}

input[type="text"], input[type="password"], input[type="email"] {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
    transition: border-color 0.2s;
}

input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus {
    border-color: #007bff;
    outline: none;
}
.form-group a {
    display: inline-block;
    margin-right: 18px;
    color: #007bff;
    text-decoration: none;
    font-size: 15px;
    transition: color 0.2s;
}

.form-group a:last-child {
    margin-right: 0;
}

.form-group a:hover {
    color: #0056b3;
    text-decoration: underline;
}
button[type="submit"] {
    width: 100%;
    padding: 10px 0;
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.2s;
}
button[type="submit"]:hover {
    background: #0056b3;
}

.btn-back {
    display: inline-block;
    background: #7f8c8d;
    color: #fff;
    border-radius: 6px;
    padding: 8px 18px;
    font-size: 15px;
    font-weight: 500;
    text-decoration: none;
    margin-top: 10px;
    margin-bottom: 10px;
    transition: background 0.2s, color 0.2s;
    border: none;
    cursor: pointer;
}
.btn-back:hover {
    background: #b2bec3;
    color: #2c3e50;
}




</style>