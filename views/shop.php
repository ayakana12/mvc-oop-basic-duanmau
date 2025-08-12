<?php
// Không cần xử lý session ở đây nữa, $cart đã được truyền từ controller
?>

<div class="main-content">
    <div class="cart-page">
        <h1>Giỏ hàng của bạn</h1>
        <div class="cart-table-wrapper">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($cart)) {
                    foreach ($cart as $item) {
                        echo '<tr>';
                        $img = isset($item['product_img']) ? $item['product_img'] : '';
                        $name = isset($item['product_name']) ? $item['product_name'] : '';
                        $price = isset($item['product_price']) ? $item['product_price'] : 0;
                        $id = isset($item['id']) ? $item['id'] : '';
                        echo '<td><img src="' . htmlspecialchars(BASE_ASSETS_UPLOADS . $img) . '" alt="' . htmlspecialchars($name) . '" class="cart-img"></td>';
                        echo '<td>' . htmlspecialchars($name) . '</td>';
                        echo '<td>' . number_format($price) . ' đ</td>';
                        echo '<td>';
                        echo '<form method="post" action="?act=delete_giohang" onsubmit="return confirm(\'Bạn có chắc muốn xóa sản phẩm này?\');">';
                        echo '<input type="hidden" name="remove_id" value="' . htmlspecialchars($id) . '">';
                        echo '<button type="submit" class="btn-remove">Xóa</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4" style="text-align:center; color:#b4332c;">Giỏ hàng trống.</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
body, html, .main-content, .cart-page, .cart-table, .cart-table th, .cart-table td, .btn-remove {
    font-family: 'Segoe UI', Arial, sans-serif !important;
}
html, body {
    overflow-x: hidden;
    overflow-y: auto;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE, Edge */
}
body::-webkit-scrollbar, html::-webkit-scrollbar {
    width: 0;
    height: 0;
    display: none; /* Chrome, Safari */
}
.main-content {
    overflow-x: hidden;
    overflow-y: auto;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE, Edge */
}
.main-content::-webkit-scrollbar {
    width: 0;
    height: 0;
    display: none;
}
.cart-page {
    overflow-x: hidden;
    overflow-y: auto;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE, Edge */
}
.cart-page::-webkit-scrollbar {
    width: 0;
    height: 0;
    display: none;
}
.main-content {
    padding-top: 90px; /* Đảm bảo không bị header che */
    min-height: calc(100vh - 90px);
    box-sizing: border-box;
}
.cart-page {
    background: #f8f9fa;
    margin: 0 auto;
    padding: 0;
    max-width: 100vw;
    box-sizing: border-box;
}
.cart-page h1 {
    text-align: center;
    color: #b4332c;
    margin-top: 30px;
    font-size: 2rem;
    letter-spacing: 2px;
}
.cart-page .cart-table-wrapper {
    max-width: 700px;
    margin: 40px auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    padding: 24px 18px;
    overflow: auto;

    /* Ẩn thanh cuộn */
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none;  /* IE 10+ */
}
.cart-page .cart-table-wrapper::-webkit-scrollbar {
    display: none; /* Chrome, Safari, Opera */
}

.cart-page .cart-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 1rem;
    background: #fff;
}
.cart-page .cart-table th, .cart-page .cart-table td {
    padding: 14px 10px;
    border-bottom: 1px solid #eee;
    text-align: left;
}
.cart-page .cart-table th {
    background: #b4332c;
    color: #fff;
    font-weight: 600;
    font-size: 1.05rem;
}
.cart-page .cart-table tr:last-child td {
    border-bottom: none;
}
.cart-page .cart-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 1px 6px #0001;
    background: #f1f1f1;
}
.cart-page .btn-remove {
    background: #e74c3c;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 6px 14px;
    cursor: pointer;
    font-size: 0.95rem;
    transition: background 0.2s;
}
.cart-page .btn-remove:hover {
    background: #c0392b;
}
@media (max-width: 700px) {
    .cart-page .cart-table-wrapper {
        max-width: 98vw;
        padding: 10px 2px;
    }
    .cart-page .cart-img {
        width: 60px;
        height: 60px;
    }
    .cart-page .cart-table th, .cart-page .cart-table td {
        padding: 8px 4px;
        font-size: 0.95rem;
    }
}
.cart-page .cart-table-wrapper {
    overflow: scroll; /* hoặc auto cũng được */
    
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE 10+ */
}

.cart-page .cart-table-wrapper::-webkit-scrollbar {
    width: 0px;
    height: 0px;
    display: none; /* Chrome, Safari, Opera */
}

</style>
