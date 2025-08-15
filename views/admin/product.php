<!-- Hiển thị sản phẩm -->
<?php
$edit_idsp=isset($_GET['id']) ?  $_GET['id'] : null; 



// Hiển thị form thêm nếu act=addproduct
if (isset($_GET['act']) && strtolower($_GET['act']) == 'addproduct') {
    ?>
    <div class="main-content add-form-page">
      <div class="container add-form-container">
        <h3>Thêm sản phẩm mới</h3>
        <form action="?act=formaddproduct" method="POST" enctype="multipart/form-data" style="max-width:500px;margin:24px 0 0 0;padding:24px 32px;border:1px solid #eee;border-radius:8px;background:#fafbfc;">
            <div style="margin-bottom:12px;">
                <label>Tên sản phẩm</label>
                <input type="text" name="name" required class="form-control" style="width:100%;">
            </div>
            <div style="margin-bottom:12px;">
                <label>Ảnh sản phẩm</label>
                <input type="file" name="img" accept="image/*" required class="form-control" style="width:100%;">
            </div>
            <div style="margin-bottom:12px;">
                <label>Danh mục</label>
                <select name="id_danhmuc" required class="form-control" style="width:100%;">
                    <?php 
                    foreach($dm as $item){
                        ?>
                        <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div style="margin-bottom:12px;">
                <label>Mô tả</label>
                <textarea name="mota" rows="3" class="form-control" style="width:100%;"></textarea>
            </div>
            <div style="margin-bottom:12px;">
                <label>Giá</label>
                <input type="number" name="price" min="0" required class="form-control" style="width:100%;">
            </div>
            <div style="margin-bottom:16px;">
                <label><input type="checkbox" name="hot" value="1"> Sản phẩm hot</label>
            </div>
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            <a href="<?= BASE_URL.'?act=product' ?>" class="btn-cancel" style="margin-left:12px;">Quay lại</a>
        </form>
      </div>
    </div>
    <?php
    return;
}
?>

<!-- Phần hiển thị sản phẩm -->
<div class="main-content">
  <div class="container">
    <h3>Danh sách sản phẩm:</h3>
    <div class="btn-them-wrap">
      <a href="<?= BASE_URL.'?act=addproduct'?>" class="btn-them">+ Thêm sản phẩm</a>
    </div>
    <div class="table-vertical-scroll"><table>
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Ảnh sản phẩm</th>
        <th>Danh mục</th>
        <th>Mô tả</th>
        <th>Giá gốc</th>
        <th>Giảm giá(%)</th>
        <th>Giá sau giảm</th>
        <th>Hành động</th>
    </tr>
    <?php 
    foreach ($product as $item){
        if($edit_idsp==$item['id']){

            //form sửa sẽ ở đây tránh bị lỗi 2 dòng và hỏng logic ////
            ?>
            <form action="<?= BASE_URL.'?act=updateproduct'?>" method="post" enctype="multipart/form-data" style="margin:0;">
            <tr class="edit-row">
                <td>
                  <?= $item['id'] ?>
                  <input type="hidden" name="id" value="<?= $item['id'] ?>">
                </td>
                <td>
                  <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" class="edit-input">
                </td>
                <td>
                  <input type="file" name="img" class="edit-input-file">
                </td>
                 <td>
                          <select name="id_danhmuc" class="edit-input" style="width:100%;">
                                <?php foreach($dm as $dm_item): ?>
                                    <option value="<?= $dm_item['id'] ?>" <?= ($dm_item['id'] == $item['id_danhmuc']) ? 'selected' : '' ?>><?= $dm_item['name'] ?></option>
                                <?php endforeach; ?>
                          </select>
                 </td>
                <td>
                  <input type="text" name="mota" value="<?= htmlspecialchars($item['mota']) ?>" class="edit-input">
                </td>
                <td>
                  <input type="number" name="price" value="<?= $item['price'] ?>" class="edit-input" min="0">
                </td>
                <td>
                  <input type="number" name="giamgia" value="<?= $item['giamgia'] ?? '' ?>" class="edit-input" min="0" max="100" style="width:60px;">%
                </td>
                <td style="color:#888; font-style:italic; background:#f8f9fa;">--</td>
                <td>
                  <button type="submit" class="btn-save">Lưu</button>
                  <a href="<?= BASE_URL.'?act=product' ?>" class="btn-cancel">Hủy</a>
                </td>
            </tr>
            </form>
            <?php

        }else {
        
        $price = floatval($item['price']);
        $giamgia = floatval($item['giamgia']);
        $gia_sau_giam = $price - ($price * $giamgia / 100);
        ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><img src="<?=BASE_ASSETS_UPLOADS. $item['img'] ?>" alt="" width="100px" height="100px" style="border-radius: 5px; box-shadow: 5px 6px 20px  #34495e;" ></td>
            <td><?= $item['tendanhmuc'] ?></td>
            <td><?= $item['mota'] ?></td>
            <td><?= $item['price'] ?></td>
            <td><?= $item['giamgia'] ?></td>
            <td><?= number_format($gia_sau_giam) ?></td>
            <td>
                <a href="<?= BASE_URL.'?act=editproduct&id='.$item['id'] ?>">Sửa</a>
                <a href="<?= BASE_URL.'?act=deleteproduct&id='.$item['id'] ?>" onclick="return confirm('Xác nhận xóa?')" class="delete">Xóa</a>
            </td>

        </tr>
        <?php
    }
    }
    ?>
    </table></div>
</div>
<style>
body {
    display: flex;
    min-height: 100vh;
    background: #ecf0f1;
}
.sidebar {
    width: 230px;
    flex-shrink: 0;
}
.main-content {
    flex: 1; /* Chiếm toàn bộ không gian còn lại trong flexbox cha (body) */
    display: flex; /* Sử dụng flexbox cho các phần tử con bên trong .main-content */
    flex-direction: column; /* Sắp xếp các phần tử con theo chiều dọc (từ trên xuống) */
    align-items: center; /* Căn giữa các phần tử con theo chiều ngang */
    justify-content: flex-start; /* Các phần tử con bắt đầu từ phía trên */
    min-height: 100vh; /* Chiều cao tối thiểu bằng chiều cao màn hình */
}
.container {
    max-width: 1200px;
    width: 100%;
    margin: 30px 0 0 0;
    padding: 32px 28px 18px 28px;
    background:rgb(137, 162, 186);
    border-radius: 12px;
    box-shadow: 0 4px 24px #0002;
    min-height: 80px;
    display: block;
}
.wqrap {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}
/* Đặt ngoài .container để nút lên góc phải trên cùng */
.btn-them-wrap {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    margin: 16px 0 8px 0;
}
.btn-them {
    background: #f1c40f;
    color: #2c3e50;
    font-weight: 600;
    padding: 8px 18px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 1rem;
    border: none;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
}
.btn-them:hover {
    background: #2c3e50;
    color: #f1c40f;
}
.container h2 {
    margin: 0;
    color: #2c3e50;
  
    font-weight: 700;
    letter-spacing: 1px;
    line-height: 1.2;
    padding-left: 4px;
}



table {
    min-width: 1100px;
    width: 100%;
    border-collapse: collapse;
    margin: 32px 0;
    background: #fff;
    box-shadow: 0 2px 8px #0001;
    font-size: 13px;
    border-radius: 8px;
    overflow: hidden;
    table-layout: fixed;
}

.table-vertical-scroll {
    width: 100%;
    max-height: 480px;
    overflow-y: auto;
    overflow-x: hidden;
    margin: 0 auto;
    padding-bottom: 8px;
    border-radius: 8px;
    box-shadow: 0 2px 8px #0001;
    background: #fff;
}

/* Giữ cố định header khi cuộn dọc */
.table-vertical-scroll table {
    border-collapse: collapse;
    width: 100%;
    min-width: 1100px;
    table-layout: fixed;
}
.table-vertical-scroll thead th {
    position: sticky;
    top: 0;
    background: #2c3e50;
    color: rgb(210, 214, 218);
    z-index: 2;
}
th, td {
    border: 1px solid #e1e1e1;
    padding: 6px 6px;
    text-align: center;
    word-break: break-word;
    white-space: pre-line;
}
th {
  background: #2c3e50;
  
    color:rgb(210, 214, 218);
    font-weight: bold;
    letter-spacing: 1px;
    font-size: 14px;
}
tr:nth-child(even) {
    background: #f8f9fa;
}
tr:hover td {
    background: #f1c40f22;
    transition: background 0.2s;
}
td img {
    max-width: 60px;
    max-height: 60px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #eee;
    background: #fafafa;
    padding: 2px;
}
a {
    color:rgb(213, 226, 240);
    background: #34495e;
    padding: 6px 14px;
    border-radius: 4px;
    text-decoration: none;
    margin: 0 3px;
    font-weight: 500;
    transition: background 0.2s, color 0.2s;
    display: inline-block;
}
a:hover {
    background: #2c3e50;
    color: #f1c40f;
}
.delete {
    background-color: #e74c3c;
    color: white;
    margin-top: 5px;
}

th:nth-child(5), td:nth-child(5) {
    min-width: 120px;
    word-break: break-word;
    white-space: pre-line;
    /* Bỏ max-width, max-height, display:block để bảng tự giãn chiều cao */
}
.form-control {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    box-sizing: border-box; /* Đảm bảo padding không làm tăng kích thước tổng thể */
    transition: border-color 0.2s;
}
.add-form-page {
    align-items: flex-start !important;
    justify-content: center !important;
    width: 100%;
}
</style>

<style>
.edit-row td {
    background: #eaf6ff !important;
    border-bottom: 2px solid #b3d1ea;
    vertical-align: middle;
    padding: 5px 6px;
}
.edit-input {
    width: 95%;
    padding: 4px 6px;
    border: 1.2px solid #b3d1ea;
    border-radius: 4px;
    font-size: 12px;
    background: #fafdff;
    transition: border 0.2s;
    outline: none;
}
.edit-input:focus {
    border: 1.2px solid #2980b9;
    background: #fff;
}
.edit-input-file {
    width: 90%;
    padding: 2px 0;
    border: none;
    background: none;
    font-size: 12px;
}
.edit-category {
    font-weight: 500;
    color: #2c3e50;
    background: #e1ecf7;
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 12px;
}
.btn-save {
    background: #27ae60;
    color: #fff;
    border: none;
    border-radius: 3px;
    padding: 4px 12px;
    font-size: 12px;
    margin-bottom: 5px;
    font-weight: 600;
    margin-right: 4px;
    cursor: pointer;
    transition: background 0.2s;
    box-shadow: 0 2px 8px #0001;
}
.btn-save:hover {
    background: #219150;
}
.btn-cancel {
    background: #7f8c8d;
    color: #fff;
    border-radius: 3px;
    padding: 4px 10px;
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
    margin-left: 2px;
    transition: background 0.2s, color 0.2s;
}
.btn-cancel:hover {
    background: #b2bec3;
    color: #2c3e50;
}
.add-form-container {
    width: 520px;
    margin-left: 0 !important;
}

