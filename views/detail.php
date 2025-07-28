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
      width: 80vw;              /* Chiếm 65% chiều rộng màn hình */
    max-width: 1200px;         /* Giới hạn tối đa */
    margin: 40px auto;        /* Căn giữa theo chiều ngang và cách trên dưới */
    padding: 0 20px; 
     flex: 1 ;
     display: flex;
     justify-content: center; /* Căn giữa ngang */
        align-items: center;     /* Căn giữa dọc nếu muốn */
     

    

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
    height: 100%;
    object-fit: cover; /* Giữ tỷ lệ, không bị méo */
    object-position: center;
    display: block;
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
    padding: 15px;
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
        

    