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
                    <div class="input-group-search">
                        <input type="text" placeholder="Tìm kiếm sản phẩm" name="keyword">
                        <button type="submit" name="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>


                <a href="<?= BASE_URL ?>" class="btn-home">
                <i class="fa-solid fa-house"></i> Trang chủ
                </a>
            </div>
        







            <div class="loginandgiohang">
            <div class="login">
                <?php
                if (isset($_SESSION['user'])) {
                    if (is_array($_SESSION['user']) && isset($_SESSION['user']['name'])) {
                        echo '<span>Xin chào, ' . htmlspecialchars($_SESSION['user']['name']) . '</span>';
                    } elseif (is_string($_SESSION['user'])) {
                        echo '<span>Xin chào, ' . htmlspecialchars($_SESSION['user']) . '</span>';
                    }
                    echo '<a href="' . BASE_URL . '?act=logout" style="margin-left:10px;">Đăng xuất</a>';
                } else {
                    echo '<a href="' . BASE_URL . '?act=login">Đăng nhập</a>';
                }
                ?>
            </div>

                <div class="giohang">
                    <a href="/cart"><i class="fa-solid fa-cart-shopping"></i>Giỏ hàng</a>
            </div>
        </section>


        <?php
    $act = $_GET['act'] ?? '/'; // Nếu không có act thì gán rỗng

    if ($act == 'detail') {
        // KHÔNG hiện banner ở trang chi tiết
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
        var tenAnh = ["banner.jpg", "banner1.jpg"];
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
        /* Header section */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #B4332C;
            padding: 15px 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-top: 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        /* Đảm bảo nội dung không bị header che khuất */
        .main-content, body > .container, body > .banner, body > .productadd {
            padding-top: 90px;
        }
        

        .logo {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
        }


    /*  */


        .timkiem {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .timkiem select {
            background: #7a2320;
            color: #fff;
            border: none;
            border-radius: 35px;
            padding: 8px 38px 8px 18px; /* tăng padding phải cho icon, padding nhỏ lại */
            font-size: 0.8rem; /* chữ nhỏ hơn */
            font-weight: 500;
            outline: none;
            min-width: 140px;
            text-align: center;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            position: relative;
            margin-right: 0;
            background: #7a2320;
            transition: background 0.2s;
        }
        .timkiem select:hover {
            background: #b4332c;
        }
        .dropdown-arrow {
            right: 10px !important;
            margin-right: 0;
            font-size: 0.9em;
            color: #fff;
        }




    /*  */

        .input-group-search {
            display: flex;
            align-items: center;
            width: 550px;
            background: #fff;
            border-radius: 30px;
            border: 1px solid #ccc;
            padding: 0 10px 0 0;
        }

        .input-group-search input[type="text"] {
            border: none;
            background: transparent;
            border-radius: 30px;
            padding: 10px 16px;
            flex: 1;
            outline: none;
            font-size: 1.1rem;
            color: #888;
        }

        .input-group-search button {
            border: none;
            background: #f8dedd;
            color: #b4332c;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
            font-size: 1.2rem;
            transition: background 0.2s;
            box-shadow: none;
        }

        .input-group-search button:hover {
            background: #0056b3;
        }




    /*  */
        .btn-home {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            color: #b4332c;
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-decoration: none;
            margin-right: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: background 0.2s, color 0.2s;
        }
        .btn-home i {
            font-size: 1rem;
        }
        .btn-home:hover {
            background: #b4332c;
            color: #fff;
        }



    /*  */

        .loginandgiohang {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .login a,
        .giohang a {
            text-decoration: none;
            color:rgb(253, 254, 255);
            font-weight: 500;
            transition: color 0.2s;
        }

        .login a:hover,
        .giohang a:hover {
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
    height: 300px; /* Chiều cao cố định, bạn có thể chỉnh lại số này */
    object-fit: cover; /* Giữ ảnh không bị méo, cắt đều */
    border-radius: 8px;
    max-height: 500px;
    transition: transform 0.6s cubic-bezier(0.4,0,0.2,1), opacity 0.6s;
    will-change: transform, opacity;
}
        </style>