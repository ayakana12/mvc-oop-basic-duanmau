<!-- Hiển thị sản phẩm -->
<?php
$edit_idsp=isset($_GET['id']) ?  $_GET['id'] : null; 
?>
<div class="main-content">
  <div class="container">
    <h3>Danh sách sản phẩm:</h3>
    <div class="btn-them-wrap">
      <a href="<?= BASE_URL.'?act=addproduct'?>" class="btn-them">+ Thêm sản phẩm</a>
    </div>
    <table>
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
            <tr>
            <form action="<?= BASE_URL.'?act=updateproduct'?>" method="post" enctype="multipart/form-data">
                <td><?= $item['id']?><input type="hidden" name="id" value="<?= $item['id'] ?>"></td>
                <td><input type="text" name="name" value="<?= $item['name'] ?>"></td>

                <td><input type="file" name="img"></td>
                <td><?= $item['id_danhmuc']?><input type="hidden" name="id_danhmuc" value="<?= $item['id_danhmuc'] ?>"></td>
                <td><input type="text" name="mota" value="<?= $item['mota'] ?>"></td>
                <td><input type="text" name="price" value="<?= $item['price'] ?>"></td>
                <td>
                    <button type="submit">Lưu</button>
                    <a href="<?= BASE_URL.'?act=product' ?>">Hủy</a>
                </td>

            </form>
            </tr>
            <?php

        }else {
        
        $gia_sau_giam = $item['price'] - ($item['price'] * $item['giamgia'] / 100);
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
</table>
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
    width: 90%;
    border-collapse: collapse;
    margin: 32px auto;
    background: #fff;
    box-shadow: 0 2px 8px #0001;
    font-size: 16px;
    border-radius: 8px;
    overflow: hidden;
   
}
th, td {
    border: 1px solid #e1e1e1;
    padding: 16px 18px;
    text-align: center;
}
th {
  background: #2c3e50;
  
    color:rgb(210, 214, 218);
    font-weight: bold;
    letter-spacing: 1px;
    font-size: 17px;
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
    min-width: 220px;
    max-width: 400px;
    word-break: break-word;
}
</style>