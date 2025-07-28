<?php 
session_start(); // Bắt đầu phiên làm việc
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminController.php';

// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/UserModel.php';
require_once './models/CategoryModel.php';

//require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Route
$act = $_GET['act'] ?? '/';


if($act=='/' || $act=='detail' || $act=='search'){
    include_once BASE_URL_LAYOUT . 'header.php';
}


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/'=>(new HomeController())->Home(),
    // Trang chi tiết sản phẩm
    'detail'=>(new HomeController())->Detail(),
    // Trang tìm kiếm sản phẩm
    'search'=>(new HomeController())->Search(),
    // Trang đăng nhập
    'login'=>(new HomeController())->Login(),
    'formlogin'=>(new HomeController())->FormLogin(),
    // Trang đăng xuất
    'logout'=>(new HomeController())->Logout(),

    // Trang quản trị viên
    'homeadmin'=>(new AdminController())->HomeAdmin(),


    // Trang quản lý danh mục
    'category'=>(new AdminController())->Category(),
    // thực hiện thêm danh mục
    'adddmuc'=>(new AdminController())->addCategory(),
    // thực hiện sửa danh mục
    'edit_id'=>(new AdminController())->editCategory(),
    'updatedmuc'=>(new AdminController())->updateCategory(),
    // thực hiện xóa danh mục
    'deletedmuc'=>(new AdminController())->deleteCategory(),
    // xóa danh mục
    

};
if($act=='/' || $act=='detail' || $act=='search'){
    include_once BASE_URL_LAYOUT . 'footer.php';
}

//kiểm  tra nếu thược trang của quản trị viên thì include header quản trị viên
if($act=='homeadmin'){
    include_once BASE_URL_LAYOUT . 'sidebar.php';
}



