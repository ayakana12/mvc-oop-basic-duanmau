<form action="<?= BASE_URL.'?act=formlogin' ?>" method="post">
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" id="username" name="name" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="pass" required>
        </div>
        <div class="form-group">
            <label for="remember">
                <input type="checkbox" id="remember" name="remember"> Ghi nhớ đăng nhập
            </label>
        </div>
        <div class="form-group">
            <a href="#">Đăng kí</a>
            <a href="#">Quên mật khẩu?</a>
        </div>
        <div class="form-group">
            <button type="submit" name="login">Đăng nhập</button>
        </div>
    </div>
</form>
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
    margin-bottom: 18px;
}
label {
    display: block;
    margin-bottom: 6px;
    color: #555;
    font-weight: 500;
}
input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
    transition: border-color 0.2s;
}

input[type="text"]:focus, input[type="password"]:focus {
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




</style>