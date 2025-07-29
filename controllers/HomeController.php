<?php
// trang  xử lí logic của trang chủ
class HomeController {

    public $productModel;
    public $userModel;
    public function __construct() {
        // Khởi tạo model
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        
    }
    


    // ///Hiển thị trang chủ
    public function Home() {
        //truyền hàm sản phẩm từ model sang view
        $products = $this->productModel->getAllSP();
        // Gọi view
        require_once BASE_URL_HOME;
    }

    // ///Hiển thị trang chi tiết sản phẩm
       function Detail(){
        if(isset($_GET['id'])){
            $product=$this->productModel->getSPById($_GET['id']);
            $products = $this->productModel->getproductsrandom($_GET['id'],4);
            require_once PATH_VIEW. 'detail.php'; // Đường dẫn tới view chi tiết sản phẩm
        }
    }
    // ///Hiển thị trang tìm kiếm sản phẩm
    function Search(){
        if(isset($_POST['button'])){
            $name=$_POST['name'];
            $tk=$_POST['tk'];
            $products = $this->productModel->getSearch($name,$tk);
            if(empty($products)){
               echo "Không tìm thấy sản phẩm nào phù hợp với từ khóa tìm kiếm.";
            }else{
                require_once BASE_URL_HOME; // Gọi view trang chủ để hiển thị sản phẩm tìm kiếm
            }

        }}


    // ///Hiển thị trang đăng nhập
    function Login(){
        // Xử lý logic đăng nhập nếu cần
        // Hiển thị view đăng nhập
        require_once PATH_VIEW . 'login.php'; // Đường dẫn tới view đăng nhập
    }
    function FormLogin(){
        // Xử lý logic đăng nhập nếu cần
        if(isset($_POST['login'])){
            $username=$_POST['name'];
            $password=$_POST['pass'];
            $remember=isset($_POST['remember']) ? true : false;
            $user = $this->userModel->getUser($username, $password);
            if($user=='admin'){
                $_SESSION['user'] = 'admin';
                header('Location: '.BASE_URL.'?act=homeadmin'); // Trang quản trị viên
                exit();
            }else if($user === 'user'){
                header('Location: '.BASE_URL); // Trang người dùng thường
                exit();
            } else {
                echo "Đăng nhập không thành công";
            }
        }

    }

    function Logout(){
        // Trang đăng xuất
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Bắt đầu phiên làm việc
        }
        // Xóa tất cả dữ liệu trong session
        session_unset();
        // Xóa session
        session_destroy();
        header('Location: '.BASE_URL); // Chuyển hướng về trang chủ
    }
}

?>