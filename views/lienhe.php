<div class="main-content">
<div class="contact-container">
    <h2>Liên hệ với chúng tôi</h2>
    <form action="" method="post" class="contact-form">
        <div class="form-group">
            <label for="name">Họ và tên:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="message">Nội dung liên hệ:</label>
            <textarea id="message" name="message" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit">Gửi liên hệ</button>
        </div>
    </form>
</div>
<script>
    function validateForm() {
        var name = document.getElementById('name').value.trim();
        var email = document.getElementById('email').value.trim();
        var message = document.getElementById('message').value.trim();

        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        if (!name || !email || !message) {
            alert('Vui lòng điền đầy đủ thông tin.');
            return false;
        }
        if (!emailPattern.test(email)) {
            alert('Email không đúng định dạng.');
            return false;
        }
        return true;
    }
</script>
<style>
body, .main-content {
    font-family: 'Segoe UI', Arial, sans-serif !important;
}

.contact-container {
    max-width: 500px;
    margin: 40px auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    padding: 32px 24px;
}
.contact-container h2 {
    color: #b4332c;
    text-align: center;
    margin-bottom: 24px;
}
.contact-form .form-group {
    margin-bottom: 18px;
}
.contact-form label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #333;
}
.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 1rem;
    box-sizing: border-box;
}
.contact-form button {
    background: #b4332c;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 10px 24px;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.2s;
}
.contact-form button:hover {
    background: #7a2320;
}
</style>
</div>
