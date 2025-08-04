<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>



<div class="container">
    <div class="col-md-6 mb-4">
         <div class="card product-card">
        
        <!-- Ảnh bên trái -->
        <div class="product-image">
            <img src="<?= BASE_ASSETS_UPLOADS . $product['img'] ?>" alt="<?= $product['name'] ?>">
            <div class="tt">
                   <h5>Thông số nổi bật:</h5>
        <!-- Thông tin bổ sung dưới ảnh -->
                    <ul class="product-info-list">
                        <li>Mô tả: <?= $product['mota'] ?? 'Đang cập nhật' ?></li>
                        <li>Xuất xứ: <?= $product['xuatxu'] ?? 'Đang cập nhật' ?></li>
                        <li>Bảo hành: <?= $product['baohanh'] ?? 'Đang cập nhật' ?></li>
                    </ul>
               
            </div>
        </div>

        <!-- Thông tin bên phải -->
        <div class="product-info">
            <div class="card-body d-flex flex-column justify-content-between h-100">
                <div>
                    <h5 class="card-title"><?= $product['name'] ?></h5>
                    <p class="card-text fw-bold"><?= number_format($product['price']) ?> đ</p>

                    <?php if (!empty($product['giamgia'])): ?>
                        <p class="card-text text-danger">Sale: <?= number_format($product['giamgia']) ?> %</p>
                    <?php endif; ?>

                    <?php if (!empty($product['hot']) && $product['hot'] == 1): ?>
                        <span class="badge bg-danger">HOT</span>
                    <?php endif; ?>
                </div>

                <!-- Nút -->
                <div class="mt-3">
                    <button class="btn btn-primary btn-sm me-2">Thêm vào giỏ</button>
                    <button class="btn btn-success btn-sm">Mua ngay</button>
                </div>
            </div>
        </div>

      </div>
   </div>
</div>


<!-- //🚩🚩🚩🚩🚩🚩🚩🚩form bình luận🚩🚩🚩🚩🚩🚩 -->


<?php
if (isset($_GET['act']) && $_GET['act'] === 'detail' && isset($_GET['id'])) {
?>
<div class="comment-wrapper">
  <div class="comment-box">
      <h4>Bình luận sản phẩm:</h4><br>
      <?php foreach ($comments as $cmt): ?>
      <div class="comment">
          <div class="comment-avatar">
              <img src="<?=BASE_ASSETS_UPLOADS. $cmt['avata'] ?>" alt="Avatar">
          </div>
          <div class="comment-content">
              <div class="name"><?= htmlspecialchars($cmt['name']) ?></div>
              <div class="text"><?= htmlspecialchars($cmt['noidung']) ?></div>
              <div class="time"><?= htmlspecialchars($cmt['date']) ?></div>
          </div>
      </div>
      <?php endforeach; ?>
        </div>
       <div class="form-contens">
      <!-- FORM GỬI BÌNH LUẬN -->
      <?php if (isset($_SESSION['user'])): ?>
      <form class="comment-form" method="post" action="<?= BASE_URL . '?act=commentbinhluan'?>">
          <input type="hidden" name="id_sp" value="<?= htmlspecialchars($_GET['id']) ?>">
          <input type="hidden" name="user_id" value="<?= isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : '' ?>">
          <input type="text" name="comment" placeholder="Viết bình luận..." required>
          <button type="submit">Gửi</button>
      </form>
      <?php else: ?>
      <div class="alert alert-warning mt-3">Bạn cần <a href="<?= BASE_URL ?>?act=login">đăng nhập</a> để bình luận.</div>
      <?php endif; ?>
      </div>
 
</div>
<?php
}
?>





<!-- //🚩🚩🚩🚩hiển thị sản phẩm liên quan 🚩🚩🚩🚩-->

<div class="productadd">
    <h3>HOT</h3>
    <div class="row">
        <?php 
          foreach($products as $item){ ?>
           <div class="col-md-3 mb-4">
            <a href="<?= BASE_URL.'?act=detail&id='.$item['id'] ?>" class="card_link">
             <div class="card-sp border rounded shadow-sm p-2">
                <img src="<?= BASE_ASSETS_UPLOADS.$item['img'] ?>" alt="">
                <div class="card-body">
                    <p class="card-title"><?= $item['name'] ?></p>
                    <p class="card-text fw-bold"><?= number_format($item['price']) ?> đ</p>
                </div>

                <div class="sale">
                    <?php 
                    if(!empty($item['giamgia'])){
                        ?>
                         <p> SALE: <?= number_format($item['giamgia']) ?> %</p> 
                        <?php
                    }
                    ?>
                    <p class="card-text">
                        <?= !empty($item['hot']) && $item['hot']==1 ? '<span class="badge bg-danger">HOT</span>' : ''  ?>
                    </p>
                </div>

             </div>
            </a>
            

           </div>
          

           <?php
            }

        ?>
    </div>


    

</div>


</body>
</html>



<style>
    html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}
body {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

footer {
    flex-shrink: 0;
}
 .container {
    width: 85vw;              /* Rộng hơn */
    max-width: 1400px;        /* Giới hạn tối đa lớn hơn */
    margin: 40px auto;
    padding: 0 38px 0 38px;   /* Padding ngang lớn hơn */
    flex: 1;
    display: flex;
    justify-content: center;
}
    .product-card {
    display: flex;
    flex-direction: row;
    height: 200px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      
    height: auto; /* cho phép nội dung cao lên nếu cần */
    
}

/* Bên trái - ảnh */
.product-image {
    width: 40%;
    overflow: hidden;
    flex-shrink: 0;

    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

.product-image img {
    width: 100%;
    max-height: 340px;
    height: auto;
    object-fit: contain; /* Không bị méo, luôn hiển thị toàn bộ ảnh */
    object-position: center;
    display: block;
    border-radius: 8px;
    background: #f8f9fa;
    box-shadow: 0 2px 8px #0001;
}
.product-info-list {
    margin: 10px 0 0 0;
    padding: 0 0 0 18px;
    font-size: 14px;
    color: #333;
}

/* Bên phải - thông tin */
.product-info {
    width: 60%;
    padding: 28px 32px 28px 32px; /* Padding lớn hơn */
    background-color: #fff;
}

.card-title {
    font-size: 18px;
    font-weight: bold;
}

.card-text.fw-bold {
    color: #28a745;
    font-size: 16px;
}

.card-body .btn {
    padding: 6px 12px;
    font-size: 14px;
    border-radius: 6px;
}
.mt-3 {
    margin-top: 15px;

    
}

 .card_link {
    text-decoration: none;
}
.card-sp {
    
    min-height: 100%;
  display: flex;
    flex-direction: column;
 
    
}
.card-sp img {
  object-fit: cover;
  height: 100%;
  width: 100%;
  margin: 4px;
}
.card-sp:hover img {
    transform: translateY(-0.2px); /* Nâng card lên 8px */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25); /* Tăng độ bóng */
    background-color: #f8f9fa; /* Đổi màu nền nhạt hơn khi hover */
    border-radius: 10px; /* Bo góc nhẹ */
}
.card-body {
  flex-grow: 1;
    display: flex;
  flex-direction: column;
  justify-content: space-between;
} 

</style>
     

<!-- 🚩🚩🚩🚩css bình luận 🚩🚩🚩🚩-->
<style>
.comment-box {
    max-width: 70%;
    height: 280px;              /* ✅ Chiều cao cố định */

    padding: 15px;
    margin: 0 auto;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #fff;
      overflow-y: auto;           /* ✅ Cho phép cuộn */
    scroll-behavior: smooth;


}
.form-contens {
    max-width: 70%;
    margin: 0 auto;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #fff;
}
.comment {
    display: flex;
    margin-bottom: 15px;
  
}
.comment-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 10px;
}
.comment-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.comment-content {
    background: #f1f1f1;
    padding: 10px 15px;
    border-radius: 10px;
    max-width: 600px;
}
.comment-content .name {
    font-weight: bold;
    margin-bottom: 5px;
}
.comment-content .text {
    margin-bottom: 5px;
}
.comment-content .time {
    font-size: 12px;
    color: #888;
}
.comment-form {
    display: flex;
    margin-top: 20px;
}
.comment-form input[type="text"] {
    flex: 1;
    padding: 10px;
    border-radius: 20px;
    border: 1px solid #ccc;
    outline: none;
}
.comment-form button {
    margin-left: 10px;
    padding: 10px 20px;
    border: none;
    background: #2e89ff;
    color: white;
    border-radius: 20px;
    cursor: pointer;
}
</style>

