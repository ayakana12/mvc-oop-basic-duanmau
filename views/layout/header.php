    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    </head>
    <body onload="start()">

        <section class="header">
        
            <div class="logo"> POLYSHOP</div>
        
            <div class="timkiem">
                 <a href="<?= BASE_URL ?>" class="btn-home">
                <i class="fa-solid fa-house"></i> Trang chủ
                </a>
                <a href="<?= BASE_URL ?>?act=lienhe" class="btn-contact">
                <i class="fa-solid fa-envelope"></i> Liên hệ
                </a>
                <!-- Form tìm kiếm sản phẩm -->
                <form action="<?= BASE_URL.'?act=search' ?>" method="post" style="display: flex; align-items: center; gap: 10px;">
                    <div style="position:relative; display:inline-block;">
                        <select name="category" id="category-select" style="width:180px;">
                            <option value="">Tất cả danh mục</option>
                            <option value="1">Máy tính</option>
                            <option value="2">Điện thoại</option>
                            <option value="3">Đồng Hồ</option>
                            <option value="4">Đồ gia dụng</option>
                        </select>
                        <span class="dropdown-arrow" style="position:absolute; right:18px; top:50%; transform:translateY(-50%); pointer-events:none;"><i class="fa-solid fa-chevron-down"></i></span>
                    </div>
                    <!-- Form tìm kiếm sản phẩm -->
                    <div class="input-group-search">
                        <input type="text" placeholder="Tìm kiếm sản phẩm" name="keyword">
                        <button type="submit" name="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>


               
            </div>
        







    <div class="loginandgiohang">
    <div class="login">
        <div class="user-menu">
            <i class="fa-solid fa-user user-icon"></i>
            <?php if (isset($_SESSION['user'])): ?>
                <span class="user-name">
                    <?= htmlspecialchars(is_array($_SESSION['user']) ? $_SESSION['user']['name'] : $_SESSION['user']) ?>
                </span>
                <select class="user-select" onchange="if(this.value) window.location.href=this.value;">
                    <option value="">Tùy chọn</option>
                    <option value="<?= BASE_URL ?>?act=update_info">Cập nhật thông tin</option>
                    <option value="<?= BASE_URL ?>?act=logout&js=1">Đăng xuất</option>
                </select>
            <?php else: ?>
                <a href="<?= BASE_URL ?>?act=login" class="login-link">Đăng nhập</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="giohang">
        <a href="?act=giohang">
            <i class="fa-solid fa-cart-shopping"></i> Giỏ hàng
        </a>
    </div>
</div>

        </section>


        <?php
    $act = $_GET['act'] ?? '/'; // Nếu không có act thì gán rỗng

    if ($act == 'detail' || $act == 'addshop' || $act == 'shop' || $act == 'giohang'|| $act == 'lienhe') {
        // KHÔNG hiện banner ở các trang này, nhưng header vẫn hiện
    } else {
        // Hiện banner ở mọi trang khác, kể cả trang chủ
        ?>  
        <div class="banner">
            <a href="#"><img id="imgbanner" src="<?=  BASE_URL_LAYOUT_BANNER.'banner.jpg'?>" alt="Banner"></a>
            <div class="banner-indicator" id="banner-indicator"></div>
        </div>
        <?php
    }
    ?>



    <script>
        var t;
        var anhar = [];
        var index = 0;
        var imgbanner = document.getElementById('imgbanner');
        var indicator = document.getElementById('banner-indicator');
        var tenAnh = ["banner.jpg", "banner1.jpg","banner2.jpg"];
        for (let i = 0; i < tenAnh.length; i++) {
            anhar[i] = new Image();
            anhar[i].src = "<?= BASE_URL_LAYOUT_BANNER ?>" + tenAnh[i];
        }
// idx là số thứ tự của ảnh banner hiện tại, giúp đồng bộ hiệu ứng indicator với ảnh.
        function updateIndicator(idx) {
            if (!indicator) return;
            let html = '';
            for (let i = 0; i < tenAnh.length; i++) {
                html += `<span class="dot${i === idx ? ' active' : ''}"></span>`;
            }
            indicator.innerHTML = html;
        }
// //rong đoạn JavaScript của bạn, biến nextSrc là tham số truyền vào cho hàm slideBanner(nextSrc). Ý nghĩa của nó:

// nextSrc là đường dẫn (URL) của ảnh banner tiếp theo sẽ được hiển thị.
// Khi gọi slideBanner(anhar[index].src), bạn truyền vào thuộc tính src của đối tượng ảnh tiếp theo trong mảng anhar.
// Bên trong hàm, imgbanner.src = nextSrc; sẽ đổi ảnh banner sang ảnh mới.
// Tóm lại:
// nextSrc là đường dẫn ảnh banner mới mà bạn muốn hiển thị khi chuyển slide.
        function slideBanner(nextSrc) {
            if (!imgbanner) return;
            imgbanner.style.transition = 'transform 0.6s cubic-bezier(0.4,0,0.2,1), opacity 0.6s';
            imgbanner.style.transform = 'translateX(-100%)'; // Ẩn sang trái
            imgbanner.style.opacity = '0';
            setTimeout(function() {
                imgbanner.src = nextSrc;
                imgbanner.style.transition = 'none';
                imgbanner.style.transform = 'translateX(100%)'; // Ảnh mới xuất hiện từ phải
                setTimeout(function() {
                    imgbanner.style.transition = 'transform 0.6s cubic-bezier(0.4,0,0.2,1), opacity 0.6s';
                    imgbanner.style.transform = 'translateX(0)';
                    imgbanner.style.opacity = '1';
                }, 20);
            }, 600);
        }

        function start() {
            if (imgbanner && anhar.length > 0) {
                slideBanner(anhar[index].src);
                updateIndicator(index);
                index++;
                if (index == anhar.length) {
                    index = 0;
                }
                t = setTimeout(start, 4000);
            }
        }
    </script>

        
    </body>
    </html>
        <style>
            

        /* Header section - all selectors scoped to .header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #B4332C;
            padding: 0 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-top: 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: auto;
            min-width: 0;
            height: 70px;
            line-height: 70px;
            box-sizing: border-box;
            z-index: 1000;
            font-family: 'Segoe UI', Arial, sans-serif !important;
        }
        .main-content, body > .container, body > .banner, body > .productadd {
            padding-top: 90px;
        }
        .header .logo {
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff;
            letter-spacing: 2px;
        }
        /* serech */
        .header .timkiem {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
            flex-shrink: 0;
            height: 38px;
            overflow: visible;
        }
        /* Cố định font cho select danh mục */
        .header .timkiem select {
            font-family: 'Segoe UI', Arial, sans-serif !important;
            background: #7a2320;
            color: #fff;
            border: none;
            border-radius: 35px;
            padding: 0 14px;
            font-size: 0.95rem;
            font-weight: 500;
            outline: none;
            min-width: 150px;
            max-width: 180px;
            width: 180px !important;
            height: 38px !important;
            line-height: 38px;
            text-align: center;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            position: relative;
            margin-right: 0;
            transition: background 0.2s;
        }
        .header .timkiem select:hover {
            background: #b4332c;
        }
        .header .dropdown-arrow {
            right: 18px !important;
            margin-right: 0;
            font-size: 0.9em;
            color: #fff;
            pointer-events: none;
        }
        .header .input-group-search {
            display: flex;
            align-items: center;
            width: 300px !important;
            max-width: 300px !important;
            min-width: 300px !important;
            background: #fff;
            border-radius: 30px;
            border: 1px solid #ccc;
            padding: 0 6px 0 0;
            height: 38px !important;
            line-height: 38px;
            flex-shrink: 0;
            box-sizing: border-box;
        }
        /* Cố định font cho input tìm kiếm */
        .header .input-group-search input[type="text"] {
            font-family: 'Segoe UI', Arial, sans-serif !important;
            border: none;
            background: transparent;
            border-radius: 30px;
            padding: 0 10px;
            flex: 1;
            outline: none;
            font-size: 1rem;
            color: #888;
            height: 38px;
            line-height: 38px;
        }
        .header .input-group-search button {
            border: none;
            background: #f8dedd;
            color: #b4332c;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
            font-size: 1.1rem;
            transition: background 0.2s;
            box-shadow: none;
        }
        .header .input-group-search button:hover {
            background: #0056b3;
        }
        .header .btn-home {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            color: #b4332c;
            border: none;
            border-radius: 25px;
            padding: 0 16px;
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            margin-right: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: background 0.2s, color 0.2s;
            height: 38px !important;
            line-height: 38px;
            min-width: 120px !important;
            max-width: 120px !important;
            width: 120px !important;
            box-sizing: border-box;
            overflow: hidden;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .header .btn-contact {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            color: #b4332c;
            border: none;
            border-radius: 25px;
            padding: 0 16px;
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            margin-right: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: background 0.2s, color 0.2s;
            height: 38px !important;
            line-height: 38px;
            min-width: 120px !important;
            max-width: 120px !important;
            width: 120px !important;
            box-sizing: border-box;
            overflow: hidden;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .header .btn-contact:hover {
            background: #b4332c;
            color: #fff;
        }
        .header .btn-home i {
            font-size: 1rem;
        }
        .header .btn-home:hover {
            background: #b4332c;
            color: #fff;
        }
        .header .loginandgiohang {
            display: flex;
            align-items: center;
            gap: 18px;
            min-height: 48px;
        }
 .login {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    min-width: 220px;
    max-width: 220px;
}

.user-menu {
    display: flex;
    align-items: center;
    background: #fff;
    border-radius: 14px;
    padding: 2px 6px;
    gap: 8px;
    font-size: 0.95rem;
    font-weight: 500;
    color: #b4332c;
    height: 40px;
    min-width: 220px;
    max-width: 220px;
    box-sizing: border-box;
    justify-content: flex-start;
    transition: none;
}

.user-name {
    flex: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: auto;
    max-width: 100px;
}

.user-select {
    flex-shrink: 0;
}



        .user-icon {
    font-size: 20px;
    background: #f3f3f3;
    border-radius: 50%;
    padding: 5px;
    margin-right: 4px;
}

 

        .user-select option:hover, .user-select option:checked {
            background: #f0f8ff;
        }
  
.user-name {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 80px;
    display: inline-block;
    box-sizing: border-box;
}


.user-select {
    font-size: 0.75rem;
    background: transparent;
    border: none;
    outline: none;
    cursor: pointer;
    width: 100px;
    color: #b4332c;
    padding: 2px 4px;
    line-height: 1;
    height: 30px;
    box-sizing: border-box;
}


.login-link {
    font-size: 0.75rem;
    text-decoration: none;
    color: #b4332c;
    padding: 2px 4px;
    transition: color 0.2s;
    white-space: nowrap;
    min-width: 220px;
    height: 40px;
    line-height: 40px;
    display: inline-block;
    box-sizing: border-box;
}

.login-link:hover {
    color: #0056b3;
}




        .header .giohang {
            display: flex;
            align-items: center;
            margin-right: 40px;
        }
        .header .giohang a {
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            color: rgb(253, 254, 255);
            font-weight: 500;
            transition: color 0.2s;
            font-size: 1.1rem;
        }
        .header .giohang a i {
            font-size: 1.2rem;
            margin-right: 4px;
        }
        .header .login a {
            text-decoration: none;
            color: rgb(253, 254, 255);
            font-weight: 500;
            transition: color 0.2s;
        }
        .header .login a:hover,
        .header .giohang a:hover {
            color: #0056b3;
        }


        /* Banner */
    .banner {
        width: 100%;
        margin-top: 10px;
        text-align: center;
        overflow-x: hidden;
        position: relative;
    }

    .banner-indicator {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: 10px;
        display: flex;
        gap: 10px;
        z-index: 2;
    }
    .banner-indicator .dot {
        width: 20px;
        height: 4px;
        border-radius: 8px;
        background: #bbb;
        display: inline-block;
        opacity: 0.5;
        transition: background 0.2s, opacity 0.2s;
    }
    .banner-indicator .dot.active {
        background: #fff;
        opacity: 1;
        box-shadow: 0 0 4px #333;
    }

.banner img {
    max-width: 100%;
    height: 200px; /* Chiều cao cố định, đã thu nhỏ lại */
    object-fit: cover; /* Giữ ảnh không bị méo, cắt đều */
    border-radius: 8px;
    max-height: 500px;
    transition: transform 0.6s cubic-bezier(0.4,0,0.2,1), opacity 0.6s;
    will-change: transform, opacity;
}
        </style>