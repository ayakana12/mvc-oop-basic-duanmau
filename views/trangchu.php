<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        html, body {
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        body {
            overflow-y: auto;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE, Edge */
        }

        body::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none; /* Chrome, Safari */
        }

        .wrapper {
            height: auto !important;
        }

        .card_link {
            text-decoration: none;
        }

        .card img {
            object-fit: contain;
            height: 220px;
            width: 100%;
            margin: 4px;
        }

        .card img:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .card {
            height: 350px;
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
</head>

<body>
    <div class="wrapper">
        <div class="main-content">
            <div class="container flex-grow-1 d-flex flex-column">
                <h4 class="special-title">Sản Phẩm HOT</h4>
                <div class="row flex-grow-1 mb-5">
                    <?php $hasHot = false; ?>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $item): ?>
                            <?php if (!empty($item['hot']) && $item['hot'] == 1): $hasHot = true; ?>
                                <div class="col-md-3 mb-4">
                                    <a href="<?= BASE_URL.'?act=detail&id='.$item['id'] ?>" class="card_link">
                                        <div class="card">
                                            <img src="<?= BASE_ASSETS_UPLOADS . $item['img'] ?>" alt="">
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
                                                        <span class="badge bg-danger">HOT</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php if (!$hasHot): ?>
                            <div class="no-product-message w-100 text-center" style="padding: 40px 0; font-size: 20px; min-height: 120px;">
                                Không có sản phẩm hot nào.
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="no-product-message w-100 text-center" style="padding: 40px 0; font-size: 20px; min-height: 120px;">
                            Không tìm thấy sản phẩm nào phù hợp với từ khóa tìm kiếm.
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sản phẩm thuộc danh mục -->
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                        <h4 class="special-title" style="font-size:1.5rem; margin-top:40px; margin-bottom:18px; color:#b4332c; animation:none;">Danh mục: <?= htmlspecialchars($cat['name']) ?></h4>
                        <div class="row flex-grow-1 mb-4">
                            <?php $hasProduct = false; ?>
                            <?php foreach ($products as $item): ?>
                                <?php if ($item['id_danhmuc'] == $cat['id']): $hasProduct = true; ?>
                                    <div class="col-md-3 mb-4">
                                        <a href="<?= BASE_URL.'?act=detail&id='.$item['id'] ?>" class="card_link">
                                            <div class="card">
                                                <img src="<?= BASE_ASSETS_UPLOADS . $item['img'] ?>" alt="">
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
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if (!$hasProduct): ?>
                                <div class="no-product-message w-100 text-center" style="padding: 20px 0; font-size: 16px; min-height: 60px;">
                                    Không có sản phẩm nào trong danh mục này.
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
