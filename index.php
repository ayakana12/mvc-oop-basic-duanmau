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

// Route
$act = $_GET['act'] ?? '/';

if(  $act=='homeadmin' || $act=='category' || $act=='product' ||$act=='category' ){
    include_once  __DIR__.'/views/layout/sidebar.php';
}
if($act=='/' || $act=='detail' || $act=='search' ){
    include_once  __DIR__.'/views/layout/header.php';
}

match ($act) {
    // Trang chủ
    '/'             => (new HomeController())->Home(),
    'detail'        => (new HomeController())->Detail(),
    'search'        => (new HomeController())->Search(),
    'login'         => (new HomeController())->Login(),
    'formlogin'     => (new HomeController())->FormLogin(),
    'logout'        => (new HomeController())->Logout(),
    'dangki'=>(new HomeController())->DangKi(), // Trang đăng ký
    'formdangki' => (new HomeController())->FormDangKi(), // Xử lý đăng ký
    'commentbinhluan' => (new HomeController())->CommentBinhLuan(), // Xử lý bình luận

    // Trang admin
    'homeadmin'     => (new AdminController())->HomeAdmin(),
    'category'      => (new AdminController())->Category(),
    'adddmuc'       => (new AdminController())->addCategory(),
    'edit_id'       => (new AdminController())->editCategory(),
    'updatedmuc'    => (new AdminController())->updateCategory(),
    'deletedmuc'    => (new AdminController())->deleteCategory(),
    'logoutadm'     => (new AdminController())->LogoutAdmin(),
    'product'       => (new AdminController())->Product(),
    // Thêm các route khác nếu cần
};
if($act=='/' || $act=='detail' || $act=='search' ){
    include_once  __DIR__.'/views/layout/footer.php';
}