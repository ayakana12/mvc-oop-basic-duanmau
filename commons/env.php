
<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

define('PATH_ROOT'    , __DIR__ . '/../');
define('BASE_URL'       , 'http://localhost/mvc-oop-basic-duanmau/');
// Đường dẫn đến trang chủ
define('BASE_URL_HOME', PATH_ROOT.'views/trangchu.php');
define('BASE_URL_LAYOUT', PATH_ROOT.'views/layout/');
define('BASE_URL_LAYOUT_BANNER', BASE_URL.'views/layout/img/');
define('PATH_VIEW', PATH_ROOT.'views/');
define('BASE_URL_ADMIN', PATH_ROOT.'views/admin/'); // Đường dẫn đến trang quản trị viên
define('BASE_ASSETS_UPLOADS', BASE_URL . 'uploads/'); // Đường dẫn đến thư mục chứa ảnh sản phẩm

define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME'    , 'duanmau');  // Tên database


