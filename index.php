<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)
session_start(); // Bắt đầu phiên làm việc
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/AdminController.php';

// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/CategoryModel.php';
require_once './models/UserModel.php';
require_once './models/CommentModel.php'; // Model cho bình luận
require_once './models/GiohangModel.php'; // Model cho giỏ hàng

// Route
$act = $_GET['act'] ?? '/';

if(  $act=='homeadmin' || $act=='category' || $act=='product' ||$act=='category'|| $act=='edit_id'|| $act=='editproduct' || $act=='updatedmuc' || $act=='deletedmuc' || $act=='logoutadm' || $act=='addproduct' || $act=='comment' || $act=='user' || $act=='edit_user' || $act=='open_user' || $act=='deletecomment' || $act=='adddmuc' || $act=='updateproduct' || $act=='deleteproduct' || $act=='formaddproduct' || $act=='dashboard'){
    include_once  __DIR__.'/views/layout/sidebar.php';
}
if($act=='/' || $act=='detail' || $act=='search' || $act=='shop'|| $act=='lienhe' || $act=='giohang' ){
    include_once  __DIR__.'/views/layout/header.php';
}

match ($act) {
    // Trang chủ
    '/'             => (new HomeController())->Home(), // trang chủ ban đầu
    'addshop'          => (new HomeController()) ->AddShop(), // lấy thông tin sản phẩm được thêm để chuyển qua home  lưu vào  database
    'giohang'          => (new HomeController())->GioHang( ), // Thêm sản phẩm vào giỏ hàng
    'muahang'      => (new HomeController())->MuaHang(), // Mua hàng 
    'delete_giohang' => (new HomeController())->DeleteGioHang(), // Xóa sản phẩm khỏi giỏ hàng

    'detail'        => (new HomeController())->Detail(), // Hiển thị trang chi tiết sản phẩm
    'search'        => (new HomeController())->Search(), // tìm kiếm sản phẩm
    'login'         => (new HomeController())->Login(),
    'formlogin'     => (new HomeController())->FormLogin(),//form nhập thông tin đăng nhập
    'logout'        => (new HomeController())->Logout(),
    'dangki'=>(new HomeController())->DangKi(), // Trang đăng ký
    'formdangki' => (new HomeController())->FormDangKi(), // Xử lý đăng ký
    'commentbinhluan' => (new HomeController())->CommentBinhLuan(), // Xử lý bình luận]
    // Trang liên hệ
    'lienhe'=> (new HomeController())->LienHe(), // Trang liên hệ
    //trang cập nhật thông tin cá nhân
    'update_info'  => (new HomeController())->UpdateInfo(), // chuyên đến trang cập nhật thông tin cá nhân
    'update_infouser' => (new HomeController())->UpdateInfouser(), // Xử lý cập nhật thông tin cá nhân
    'delete_user' => (new HomeController())->DeleteUser(), // Xóa người dùng


    // Trang admin
    'homeadmin'     => (new AdminController())->HomeAdmin(), // trang quản trị viên

    // trang dashboard
    'dashboard'     => (new AdminController())->Dashboard(), // Trang dashboard quản trị viên
    // Trang quản lý danh mục
    'category'      => (new AdminController())->Category(), // Trang quản lý danh mục
    'adddmuc'       => (new AdminController())->addCategory(), 
    'edit_id'       => (new AdminController())->editCategory(),
    'updatedmuc'    => (new AdminController())->updateCategory(),
    'deletedmuc'    => (new AdminController())->deleteCategory(),
    'logoutadm'     => (new AdminController())->LogoutAdmin(),

    // Trang quản lý sản phẩm
    'product'       => (new AdminController())->Product(),
    'addproduct'    => (new AdminController())->addProduct(),// Thêm sản phẩm
    'updateproduct' => (new AdminController())->updateProduct(), // Cập nhật sản
    'deleteproduct'=> (new AdminController())->deleteProduct(), // Xóa sản phẩm
    'editproduct'=> (new AdminController())->editProduct(), // Sửa sản phẩm
    'formaddproduct' => (new AdminController())->FormAddProduct(), // Hiển thị form thêm sản phẩm

    // Trang xử lý bình luận
    'comment'       => (new AdminController())->Comment(), // Trang xử lý bình luận
    'deletecomment' => (new AdminController())->deleteComment(), // Xóa bình luận

    // Trang quản lý người dùng
    'user'         => (new AdminController())->User(), // Trang quản lý người dùng
    'edit_user'=> (new AdminController())->EditUser(), // khóa người dùng
    'open_user'=> (new AdminController())->OpenUser(), // mở lại tài khoản người dùng
    'change_role'=> (new AdminController())->ChangeRole(), // phân quyền người dùng quyền người dùng
   

    // Thêm các route khác nếu cần
};
if($act=='/' || $act=='detail' || $act=='search' || $act=='shop' || $act=='giohang'){
    include_once  __DIR__.'/views/layout/footer.php';
}