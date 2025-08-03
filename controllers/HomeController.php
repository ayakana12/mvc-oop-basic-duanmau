<?php
// trang  xử lí logic của trang chủ
class HomeController {

    public $productModel;
    public $userModel;
    public $comment;
    public function __construct() {
        // Khởi tạo model
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->comment= new Comment(); // Khởi tạo model bình luận
        
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
            //truyền vào hàm  lấy bình luận của sản phẩm
            $comments = $this->comment->getAllComment($_GET['id']);
            $products = $this->productModel->getproductsrandom($_GET['id'],4);
            require_once PATH_VIEW. 'detail.php'; // Đường dẫn tới view chi tiết sản phẩm
        }
    }
    // ///Hiển thị trang tìm kiếm sản phẩm
    function Search(){
        if(isset($_POST['button'])){
            $category = isset($_POST['category']) ? $_POST['category'] : '';
            $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
            $products = $this->productModel->getSearch($category, $keyword);
            if(empty($products)){
               echo "Không tìm thấy sản phẩm nào phù hợp với từ khóa tìm kiếm.";
            }else{
                require_once BASE_URL_HOME; // Gọi view trang chủ để hiển thị sản phẩm tìm kiếm
            }
        }
    }


    // 🚩🚩🚩🚩🚩🚩Hiển thị trang đăng nhập
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



    // 🚩🚩🚩🚩🚩🚩Hiển thị trang đăng ký
    function Dangki(){
        require_once PATH_VIEW . 'dangki.php'; // Đường dẫn tới view đăng ký
    }
    function FormDangKi(){
        if(isset($_POST['login'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $confirm_pass = $_POST['confirm_pass'];
            $avatar = $_FILES['avatar'] ?? null;
            // Kiểm tra điều kiện đăng ký
            if($pass !== $confirm_pass){
                echo "<script>alert('Mật khẩu xác nhận không khớp.');window.history.back();</script>";
                return;
            }
            // Kiểm tra email đã tồn tại chưa
            if($this->userModel->emailExists($email)){
                echo "<script>alert('Email đã tồn tại. Vui lòng dùng email khác!');window.history.back();</script>";
                return;
            }
            // Gọi hàm đăng ký người dùng từ model
            $this->userModel->addUser($name, $email, $pass, $avatar);
            echo "<script>alert('Đăng ký thành công!');window.location.href='".BASE_URL."?act=login';</script>";
        }
    }






    // 🚩🚩🚩🚩🚩🚩🚩🚩Xử lý gửi bình luận sản phẩm
    public function CommentBinhLuan() {
        if (!isset($_SESSION['user'])) {
            echo "<script>alert('Bạn cần đăng nhập để bình luận!'); window.history.back();</script>";
            return; 
        }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id_sp = $_POST['id_sp'] ?? '';
            $content = $_POST['comment'] ?? '';
            $id_user = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
            if (!$id_user || !$content) {
                // Xử lý lỗi: chưa đăng nhập hoặc không có nội dung
                return;
            }
            // Gọi hàm thêm bình luận trong model
            $this->comment->addComment($id_sp, $content, $id_user);
        }
        // Quay lại trang chi tiết sản phẩm (chưa xử lý lưu bình luận)
        header('Location: ' . BASE_URL . '?act=detail&id=' . ($_POST['id_sp'] ?? ''));
        exit;
    }
}

?>