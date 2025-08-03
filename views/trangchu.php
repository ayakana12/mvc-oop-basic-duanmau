<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="wrapper">
  

  <div class="container flex-grow-1 d-flex flex-column">
      <h4 class="special-title">Sản Phẩm Ưu Đãi</h4>
      <div class="row flex-grow-1">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $item): ?>
                <div class="col-md-3 mb-4 ">
                <a href="<?= BASE_URL.'?act=detail&id='.$item['id'] ?>" class="card_link">
                    <div class="card">
                        <img src="<?=BASE_ASSETS_UPLOADS. $item['img'] ?>" alt="" >
                        <div class="card-body">
                            <h5 class="card-title"><?= $item['name'] ?></h5>
                            <p class="card-text fw-bold"><?= number_format($item['price']) ?> đ</p>
                         <div class="sale">
                         <?php if (!empty($item['giamgia'])): ?>
                                <p class="card-text text-danger">
                                    Sale: <?= number_format($item['giamgia']) ?> %
                                </p>
                            <?php endif; ?>
                            <p class="card-text">
                                <?= !empty($item['hot']) && $item['hot'] == 1 ? '<span class="badge bg-danger">HOT</span>' : '' ?>
                            </p>
                         </div>
                        </div>
                     </div>
                </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-product-message w-100 text-center" style="padding: 40px 0; font-size: 20px; min-height: 120px;">Không tìm thấy sản phẩm nào phù hợp với từ khóa tìm kiếm.</div>
        <?php endif; ?>
      </div>
  </div>


</div>
</body>

</html>
<style>

    
    .card_link {
    text-decoration: none;
}


    .card img {
  object-fit: contain; /* dùng cái này khi ảnh quá to so với khung thì nó sẽ tự thi cho vừa khung tránh bị vỡ  */
  height: 220px;
  width: 100%;
  margin: 4px;
}
.card img:hover {
    transform: translateY(-1px); /* Nâng card lên 8px */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25); /* Tăng độ bóng */
    background-color: #f8f9fa; /* Đổi màu nền nhạt hơn khi hover */
    border-radius: 10px; /* Bo góc nhẹ */
}
.card {
  height: 400px; /* Chiều cao cố định cho tất cả card */
  display: flex;
  flex-direction: column;
}
.card-body {
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  overflow: hidden;
}
.sale {
    display: flex;
    gap: 40px;
}


    .special-title {
        margin-top: 50px;
        margin-bottom: 24px;
        text-align: center;
        font-size: 2.1rem;
        font-weight: bold;
        letter-spacing: 2px;
        color: #e74c3c;
        text-shadow: 2px 2px 8px rgba(231,76,60,0.15), 0 2px 8px rgba(0,0,0,0.08);
        transition: color 0.3s, text-shadow 0.3s;
        position: relative;
        z-index: 1;
        animation: blinkTitle 1.2s infinite alternate;
    }

    @keyframes blinkTitle {
        0% {
            color: #e74c3c;
            text-shadow: 2px 2px 8px rgba(231,76,60,0.15), 0 2px 8px rgba(0,0,0,0.08);
        }
        50% {
            color: #e8796dff;
            text-shadow: 0 0 16px #e74c3c, 0 2px 12px rgba(0,0,0,0.15);
        }
         70% {
            color: #ab5249ff;
            text-shadow: 0 0 16px #e74c3c, 0 2px 12px rgba(0,0,0,0.15);
        }
        100% {
            color: #e74c3c;
            text-shadow: 2px 2px 8px rgba(231,76,60,0.15), 0 2px 8px rgba(0,0,0,0.08);
        }
    }
    .special-title:hover {
        color: #c0392b;
        text-shadow: 0 4px 16px rgba(231,76,60,0.25), 0 2px 12px rgba(0,0,0,0.15);
     
    }
</style>
