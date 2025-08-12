<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Ẩn thanh cuộn dọc */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE, Edge */
        }

        body::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none; /* Chrome, Safari */
        }

        .container {
            width: 85vw;
            max-width: 1400px;
            margin: 40px auto 7px auto;
            padding: 7px 38px;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main-content {
            margin: 30px 0 7px 0;
            padding: 7px 0;
        }

        .product-card {
            display: flex;
            flex-direction: row;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 7px;
            padding: 7px;
        }

        .product-image {
            width: 40%;
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }

        .product-image img {
            width: 100%;
            max-height: 340px;
            height: auto;
            object-fit: contain;
            object-position: center;
            border-radius: 8px;
            background: #f8f9fa;
            box-shadow: 0 2px 8px #0001;
        }

        .product-info {
            width: 60%;
            padding: 28px 32px;
            background-color: #fff;
        }

        .product-info-list {
            margin: 10px 0 0 0;
            padding: 0 0 0 18px;
            font-size: 14px;
            color: #333;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card-text.fw-bold {
            color: #28a745;
            font-size: 16px;
        }

        .badge-hot {
            padding: 4px 14px;
            margin-left: 8px;
            margin-right: 8px;
            font-size: 16px;
            border-radius: 14px;
            letter-spacing: 1px;
            box-shadow: 0 4px 16px #e74c3c33;
            vertical-align: middle;
            display: inline-block;
            white-space: nowrap;
            background: linear-gradient(90deg, #e74c3c 80%, #ffb3b3 100%);
            color: #fff;
            font-weight: 700;
            border: 1.5px solid #fff0f0;
            text-shadow: 0 2px 8px #e74c3c44;
        }

        .card-sp {
            height: auto;
            min-height: 290px;
            min-width: 180px;
            max-width: 240px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            padding: 14px 10px;
            background: #fff;
            overflow: hidden;
        }

        .card-sp img {
            width: 100%;
            height: 160px;
            object-fit: contain;
            border-radius: 8px;
            background: #f8f9fa;
            box-shadow: 0 2px 8px #0001;
            padding: 4px;
        }

        .card-sp .card-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
            text-align: center;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .card-sp .card-text.fw-bold {
            font-size: 15px;
            color: #28a745;
            text-align: center;
        }

        /* Sửa phần này cho các thành phần trong .sale thẳng hàng */
        .sale {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            margin-top: 6px;
        }

        /* Comment box */
        .comment-box {
            max-width: 70%;
            height: 280px;
            padding: 15px;
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            overflow-y: auto;
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
        .productadd h3 {
    margin-left: 55px;
    font-size: 2rem;
    font-weight: 700;
    background: linear-gradient(90deg, #ff416c, #ff4b2b);
  -webkit-background-clip: text;
-webkit-text-fill-color: transparent;
 margin-bottom: 20px;
    position: relative;
    animation: slideIn 1s ease forwards;
    cursor: default;
}

.productadd h3::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 50px;
    height: 3px;
    background: #ff416c;
    border-radius: 2px;
    animation: underlineMove 2s ease-in-out infinite alternate;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes underlineMove {
    0% {
        width: 30px;
        background: #ff416c;
    }
    50% {
        width: 60px;
        background: #ff4b2b;
    }
    100% {
        width: 30px;
        background: #ff416c;
    }
}


    </style>
</head>
<body>

    <div class="main-content">
        <div class="container">
            <div class="col-md-6 mb-4">
                <div class="card product-card">
                    <!-- Ảnh bên trái -->
                    <div class="product-image">
                        <img src="<?= BASE_ASSETS_UPLOADS . $product['img'] ?>" alt="<?= $product['name'] ?>" />
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

                                <?php if (!empty($product['giamgia'])) : ?>
                                    <p class="card-text text-danger">Sale: <?= number_format($product['giamgia']) ?> %</p>
                                <?php endif; ?>

                                <?php if (!empty($product['hot']) && $product['hot'] == 1) : ?>
                                    <span class="badge bg-danger badge-hot">HOT</span>
                                <?php endif; ?>
                            </div>

                            <!-- Nút -->
                            <div class="mt-3">
                            
                                <a href="?act=addshop&id=<?= $product['id'] ?>" class="btn btn-primary btn-sm me-2">Thêm giỏ hàng</a>

                                <a href="?act=muahang" class="btn btn-success btn-sm">Mua ngay</a>
                            </div>
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
                <h4>Bình luận sản phẩm:</h4><br />
                <?php foreach ($comments as $cmt) : ?>
                    <div class="comment">
                        <div class="comment-avatar">
                            <img src="<?=  $cmt['avata'] ?>" alt="Avatar" />
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
                <?php if (isset($_SESSION['user'])) : ?>
                    <form class="comment-form" method="post" action="<?= BASE_URL . '?act=commentbinhluan' ?>">
                        <input type="hidden" name="id_sp" value="<?= htmlspecialchars($_GET['id']) ?>" />
                        <input type="hidden" name="user_id" value="<?= isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : '' ?>" />
                        <input type="text" name="comment" placeholder="Viết bình luận..." required />
                        <button type="submit">Gửi</button>
                    </form>
                <?php else : ?>
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
            foreach ($products as $item) { ?>
                <div class="col-md-3 mb-4">
                    <a href="<?= BASE_URL . '?act=detail&id=' . $item['id'] ?>" class="card_link">
                        <div class="card-sp border rounded shadow-sm p-2">
                            <img src="<?= BASE_ASSETS_UPLOADS . $item['img'] ?>" alt="" />
                            <div class="card-body">
                                <p class="card-title"><?= $item['name'] ?></p>
                                <p class="card-text fw-bold"><?= number_format($item['price']) ?> đ</p>
                            </div>

                            <div class="sale">
                                <?php
                                if (!empty($item['giamgia'])) {
                                ?>
                                    <p>SALE: <?= number_format($item['giamgia']) ?> %</p>
                                <?php
                                }
                                ?>
                                <p class="card-text">
                                    <?= !empty($item['hot']) && $item['hot'] == 1 ? '<span class="badge bg-danger badge-hot">HOT</span>' : '' ?>
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
