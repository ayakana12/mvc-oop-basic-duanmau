<?php
// trang  xử lí logic của trang chủ
class HomeController {

    public $productModel;
    public $userModel;
    public $comment;

    public $giohangModel; // Model cho giỏ hàng
    public function __construct() {
        // Khởi tạo model
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
        $this->comment= new Comment(); // Khởi tạo model bình luận
        $this->giohangModel = new GioHang(); // Khởi tạo model giỏ hàng 
        
    }
    


  //Hiển thị trang chủ
    public function Home() {
        // Lấy tất cả sản phẩm và danh mục, truyền ra view
        $products = $this->productModel->getAllSP();
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();
        // Gọi view
        require_once BASE_URL_HOME;
    }
    
    // trang cập nhật thông tin cá nhân người dùng

    public function UpdateInfo(){
        require_once PATH_VIEW . 'update_info.php'; // Đường dẫn tới view cập nhật thông tin cá nhân
    }
    public function UpdateInfouser() {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user'])) {
            header('Location: '.BASE_URL.'?act=login');
            exit;
        }
        // Lấy thông tin người dùng từ session
        $user = $_SESSION['user'];
        
        // Xử lý cập nhật thông tin nếu có dữ liệu gửi lên
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? $user['name'];
            $email = $_POST['email'] ?? $user['email'];
            $avatar = $_FILES['avatar'] ?? null;
            $password = $_POST['password'] ?? '';
            if (empty($password)) {
                $password = $user['pass'];
            }
            $address = $_POST['address'] ?? $user['address'];
            $this->userModel->updateUser($user['id'], $name, $email, $address, $avatar, $password);
            header('Location: '.BASE_URL);
            exit;
        }
        
       
        require_once BASE_URL_HOME ;
    }
    // khi người dùng muốn  hủy tài khoản
    public function DeleteUser() {
        //kiểm tra đăng nhập
        if(!isset($_SESSION['user'])) {
            header('Location: '.BASE_URL.'?act=login');
            exit;
        }
        // Lấy ID người dùng từ session
        $userId = $_SESSION['user']['id'] ?? null;
        if ($userId) {
            // Gọi hàm xóa người dùng trong model
            $this->userModel->deleteUser($userId);
            // Xóa session và chuyển hướng về trang đăng nhập
            session_unset();
            session_destroy();
            header('Location: '.BASE_URL.'?act=login');
            exit;
        } else {
            // Nếu không có ID người dùng, chuyển hướng về trang chủ hoặc thông báo lỗi
            header('Location: '.BASE_URL);
            exit;
        }
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

    
    // lấy thông tin sản phẩm được thêm để chuyển qua home  lưu vào  database
    function AddShop(){
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user'])) {
            header('Location: '.BASE_URL.'?act=login');
            exit;
        }
        if(isset($_GET['id'])){
            $product_id = $_GET['id'];
            $user_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : $_SESSION['user'];
            $this->giohangModel->addToCart($product_id, $user_id);
            header('Location: '.BASE_URL.'?act=giohang');
            exit;
        }
    }
    // Hàm hiển thị giỏ hàng
    function GioHang() {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user'])) {
            header('Location: '.BASE_URL.'?act=login');
            exit;
        }
        $user_id = $_SESSION['user']['id'] ?? $_SESSION['user'];
        $cart = $this->giohangModel->getCart($user_id);
        require_once PATH_VIEW . 'shop.php';
    }
    // Hàm xóa sản phẩm khỏi giỏ hàng
    function DeleteGioHang() {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user'])) {
            echo "<script>alert('Vui lòng đăng nhập để xóa sản phẩm khỏi giỏ hàng!'); window.location.href='" . BASE_URL . "?act=login';</script>";
            exit;
        }
        if (isset($_POST['remove_id'])) {
            $remove_id = $_POST['remove_id'];
            $user_id = $_SESSION['user']['id'] ?? $_SESSION['user'];
            // Gọi hàm xóa sản phẩm khỏi giỏ hàng trong model
            $this->giohangModel->deleteFromCart($remove_id, $user_id);
            // Chuyển hướng, không load view nào ở đây!
            header('Location: '.BASE_URL.'?act=giohang');
            exit;
        }
        // Nếu không có remove_id, không làm gì cả, không load view ở đây!
    }
    function MuaHang(){
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user'])) {
            header('Location: '.BASE_URL.'?act=login');
            exit;
        }
        // Xử lý logic mua hàng ở đây (xóa giỏ hàng trong DB nếu cần)
        echo "<script>alert('Cảm ơn bạn đã mua hàng!'); window.location.href='".BASE_URL."';</script>";
        exit;
    }

  //Hiển thị trang tìm kiếm sản phẩm
    function Search(){
        if(isset($_POST['button'])){
            $category = isset($_POST['category']) ? $_POST['category'] : '';
            $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
            if($keyword === ''){
                // Nếu không nhập từ khóa thì chuyển về trang chủ,
                echo "<script>window.location.href='" . BASE_URL . "';</script>";
                exit();
            }
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
                // Có thể chuyển hướng hoặc xử lý lỗi ở đây nếu muốn
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
        if (isset($_GET['js']) && $_GET['js'] == '1') {
            // Trả về JS chuyển hướng, không dùng header Location
            echo "<script>window.location.href='".BASE_URL."';</script>";
            exit;
        } else {
            header('Location: '.BASE_URL); // Chuyển hướng về trang chủ
            exit;
        }
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
            $address = $_POST['address'] ?? ''; // Lấy địa chỉ từ form đăng ký

          
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
            $this->userModel->addUser($name, $email, $pass, $avatar,$address);
            echo "<script>alert('Đăng ký thành công!');window.location.href='".BASE_URL."?act=login';</script>";
        }
    }






    // 🚩🚩🚩🚩🚩🚩🚩🚩Xử lý gửi bình luận sản phẩm
    public function CommentBinhLuan() {
        if (!isset($_SESSION['user'])) {
            header('Location: '.BASE_URL.'?act=login');
            exit;
        }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id_sp = $_POST['id_sp'] ?? '';
            $content = $_POST['comment'] ?? '';
            $id_user = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
            if (!$id_user || !$content) {
                // Xử lý lỗi: chưa đăng nhập hoặc không có nội dung
                header('Location: ' . BASE_URL . '?act=detail&id=' . ($id_sp ?? ''));
                exit;
            }
            // Gọi hàm thêm bình luận trong model
            $this->comment->addComment($id_sp, $content, $id_user);
        }
        header('Location: ' . BASE_URL . '?act=detail&id=' . ($_POST['id_sp'] ?? ''));
        exit;
    }
    function LienHe(){
        // Xử lý gửi liên hệ nếu có dữ liệu POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Xử lý lưu thông tin liên hệ nếu cần (bạn có thể bổ sung lưu DB ở đây)
            echo "<script>alert('Gửi liên hệ thành công! Chúng tôi sẽ phản hồi sớm nhất.'); window.location.href='".BASE_URL."';</script>";
            exit;
        }
        // Hiển thị view liên hệ
        require_once PATH_VIEW . 'lienhe.php'; // Đường dẫn tới view liên hệ
    }

   
}

?>