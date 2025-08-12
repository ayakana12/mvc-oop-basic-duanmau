<?php
// Trang cập nhật thông tin cá nhân người dùng

$user = is_array($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<div class="update-info-container">
    <h2>Cập nhật thông tin cá nhân</h2>
    <form action="?act=update_infouser" method="post" class="update-info-form" enctype="multipart/form-data">
        <label>Tên người dùng:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>

        <label>Địa chỉ:</label>
        <input type="text" name="address" value="<?= htmlspecialchars($user['address'] ?? '') ?>">

        <label>Ảnh đại diện:</label>
        <input type="file" name="avatar" accept="image/*">

        <label>Mật khẩu mới (bỏ trống nếu không đổi):</label>
        <input type="password" name="password" placeholder="Nhập mật khẩu mới">

        <button type="submit" name="update">Cập nhật</button>
    </form>

    <!-- Form xóa tài khoản -->
    <form action="?act=delete_user" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản? Hành động này không thể hoàn tác!');">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['id'] ?? '') ?>">
        <button type="submit" name="delete_account" class="delete-button">Xóa tài khoản</button>
    </form>
    <a href="<?= BASE_URL.'?act=/' ?>">Quay lại</a>
</div>

<style>
.update-info-container {
    max-width: 400px;
    margin: 40px auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    padding: 32px 28px;
}
.update-info-container h2 {
    text-align: center;
    margin-bottom: 24px;
    color: #b4332c;
}
.update-info-form label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #333;
}
.update-info-form input {
    width: 100%;
    padding: 8px 12px;
    margin-bottom: 18px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 1rem;
}
.update-info-form button,
.delete-button {
    width: 100%;
    padding: 10px 0;
    margin-top: 10px;
    font-size: 1.1rem;
    font-weight: 600;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.2s;
}
.update-info-form button {
    background: #b4332c;
    color: #fff;
}
.update-info-form button:hover {
    background: #a12a22;
}
.delete-button {
    background: #888;
    color: #fff;
}
.delete-button:hover {
    background: #666;
}
</style>
