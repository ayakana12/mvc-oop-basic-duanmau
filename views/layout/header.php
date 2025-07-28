<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

    <section class="header">
      
        <div class="logo"> POLYSHOP</div>
    
        <div class="timkiem">
            <!-- Form tìm kiếm sản phẩm -->
            <form action="<?= BASE_URL.'?act=search' ?>" method="post" style="display: flex; align-items: center; gap: 10px;">
                <select name="name" id="" >   
                    <option value="1">Máy tính</option>
                    <option value="2">Điện thoại</option>
                    <option value="3">Đồng Hồ</option>
                    <option value="4">Đồ gia dụng</option>
                </select>
                   <span class="dropdown-arrow"><i class="fa-solid fa-chevron-down"></i></span>
             
                <div class="input-group-search">
                    <input type="text" placeholder="Tìm kiếm sản phẩm" name="tk">
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
              if (isset($_SESSION['user'])){ 
                ?>
                    <span>Xin chào, <?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                    <a href="<?= BASE_URL ?>?act=logout" style="margin-left:10px;">Đăng xuất</a>
                <?php 
             }else{ 
                   ?>
                     <a href="<?= BASE_URL ?>?act=login">Đăng nhập</a>
                  <?php
                   } 
            ?>
           </div>

            <div class="giohang">
                <a href="/cart"><i class="fa-solid fa-cart-shopping"></i>Giỏ hàng</a>
          </div>
    </section>


    <div class="banner">
    <a href="#"><img src="/DỰ án mẫu/views/layout/img/banner.jpg" alt=""></a>
   </div>

    
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
    }

    .logo {
        font-size: 2rem;
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
        padding: 10px 28px 10px 22px;
        font-size: 0.9rem;
        font-weight: 500;
        outline: none;
        min-width: 160px;
        text-align: center;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        position: relative;
        margin-right: -11px;
        background: #7a2320;
        transition: background 0.2s;
      
    }
    .timkiem select:hover {
        background: #b4332c;
    }
    .dropdown-arrow {
        margin-right: 10px;
      
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
        font-size: 1.1rem;
        font-weight: 600;
        text-decoration: none;
        margin-right: 18px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        transition: background 0.2s, color 0.2s;
    }
    .btn-home i {
        font-size: 1.2rem;
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
}

.banner img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    max-height: 500px;
}
    </style>