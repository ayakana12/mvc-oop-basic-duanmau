
<?php 
// trang xử lý các yêu cầu liên quan đến quản trị viên

class AdminController {
    public $category;
    public $productModel;
    public $comment;

    public $userModel;
    public function __construct() {
        if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
            header('Location: '.BASE_URL.'?act=login');
            exit;
        }
        // Khởi tạo model nếu cần
        $this->category = new CategoryModel(); // có model CategoryModel để quản lý danh mục
        //  khởi tạo đối tượng model sản phẩm
        $this->productModel = new ProductModel(); //  model ProductModel để quản lý sản phẩm
        $this->comment = new Comment(); // Khởi tạo model bình luận
        $this->userModel = new UserModel(); // Khởi tạo model người dùng

    }

    // Hàm xử lý trang quản trị viên
    public function HomeAdmin() {
        // Logic để lấy dữ liệu cần thiết cho trang quản trị viên
        // Ví dụ: lấy danh sách người dùng, sản phẩm, v.v.
        
        // Gọi view quản trị viên
        require_once BASE_URL_ADMIN . 'homeAD.php'; // Đường dẫn tới view quản trị viên
    }


    // Hàm xử lý trang dashboard
     // Trang dashboard admin
    public function Dashboard() {
        // Tổng số user
        $userCount = count($this->userModel->getAllUsers());
        // Tổng số sản phẩm
        $productCount = count($this->productModel->getAllSP());
        // Tổng số danh mục
        $categoryModel = new CategoryModel();
        $categoryCount = count($categoryModel->getAllCategories());
        // Tổng số bình luận
        $commentModel = new Comment();
        $commentCount = count($commentModel->getAllComment1());

        // 5 user mới nhất
        $latestUsers = array_slice($this->userModel->getAllUsers(), -5);
        // 5 sản phẩm mới nhất
        $latestProducts = array_slice($this->productModel->getAllSP(), -5);
        // Gọi view dashboard
        require_once PATH_VIEW . 'admin/dashboard.php';
    }


    // Hàm xử lý trang quản lý danh mục////////////
    public function Category() {
        // Logic để lấy dữ liệu danh mục
        // Ví dụ: lấy danh sách danh mục từ model
        $Categories = $this->category->getAllCategories();   
        // Gọi view quản lý danh mục
        require_once BASE_URL_ADMIN . 'danhmuc.php'; // Đường dẫn tới view quản lý danh mục
    }

    // Hàm thực hiện thêm danh mục
    public function addCategory(){
         if($_SERVER['REQUEST_METHOD']=='POST'){
           $name=$_POST['name']??'';
        
           $this->category->addCategory($name);
           header('Location: '.BASE_URL.'?act=category');
           exit;
        }
   
        }


    public function editCategory() {
        if(isset($_GET['id'])){

            //truyền vào hàm duyệt tất cả danh mục trong trường danh mục khi ko nhấn sửa  để hiển thị
            $Categories = $this->category->getAllCategories();
            require_once BASE_URL_ADMIN . 'danhmuc.php'; // Đường dẫn tới view quản lý danh mục
        }
    
    }
    //🚩 Hàm thực hiện cập nhật danh mục
    public function updateCategory() {
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id=$_POST['id']??'';
            $name=$_POST['name']??'';
            $quantily=$_POST['quantily']??'';
            //gọi hàm cập nhật danh mục trong model
            $this->category->updateCategory($id, $name, $quantily);
            header('Location: '.BASE_URL.'?act=category');
            exit;
        }
    }


    //🚩hàm thực hiên xóa danh mục
    public function deleteCategory(){
        if(isset($_GET['id'])){
            //gọi hàm xóa danh mục trong model
            $this->category->deleteCategory($_GET['id']);
            header('Location: '.BASE_URL.'?act=category');
            exit;
        }

    }

    // 🚩Hàm đăng xuất admin
    public function LogoutAdmin() {
        session_start();
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        session_unset();
        session_destroy();
        header('Location: '.BASE_URL);
        exit;
    }
    //🚩🚩🚩/////////////////////////////(Bắt đầu từ đây hàm sử lý trang quản lý sản phẩm)////////🚩🚩🚩//


    //hàm hiển thị  tất cả 
    function Product(){
        $product=$this->productModel->getAllSP();
        //Hiển thị danh sách sản phẩm ra 
        require_once BASE_URL_ADMIN . 'product.php'; // Đường dẫn tới view quản lý sản phẩm
    }
    function deleteProduct(){
        if(isset($_GET['id'])){
            //gọi hàm xóa sản phẩm trong model
            $this->productModel->deleteProduct($_GET['id']);
            header('Location: '.BASE_URL.'?act=product');
            exit;
        }
    }

    //cập nhật sản phẩm
    function editProduct(){
        if(isset($_GET['id'])){
            // Lấy danh sách sản phẩm để truyền sang view
            $product = $this->productModel->getAllSP();
            require_once BASE_URL_ADMIN . 'product.php'; // Đường dẫn tới view quản lý sản phẩm
            exit;
        }
    }
       function updateProduct(){
     if(isset($_POST['id'])){
          $id = $_POST['id'];
          $name = $_POST['name'];
          $img = $_FILES['img']['name'];
          $id_danhmuc = isset($_POST['id_danhmuc']) ? $_POST['id_danhmuc'] : 0;
          $id_danhmuc = (is_numeric($id_danhmuc) && $id_danhmuc !== '') ? intval($id_danhmuc) : 0;
          $mota = $_POST['mota'];
          $price = $_POST['price'];

          // Xử lý ảnh
          if ($img) {
              move_uploaded_file($_FILES['img']['tmp_name'], PATH_ASSETS_UPLOADS . $img);
          } else {
              $img = $this->productModel->getImgById($id);
          }

          // cập nhật sản phẩm (truyền đúng thứ tự tham số)
          $this->productModel->updateProduct($id, $name, $img, $id_danhmuc, $mota, $price);
          header('Location: '.BASE_URL.'?act=product');
     }
    }

    //  Hàm thêm sản phẩm
    function addProduct(){
        $dm=$this->category->getAllCategories(); // Lấy danh sách danh mục để hiển thị trong form
        require_once BASE_URL_ADMIN . 'product.php'; // Đường dẫn tới view quản lý sản phẩm
        
    }
    //lấy thông tin  sản phẩm thừ form thêm  để lưu vào csdl
    function FormAddProduct(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $name = $_POST['name'] ?? '';
            $img = $_FILES['img']['name'] ?? '';
            $id_danhmuc = isset($_POST['id_danhmuc']) ? $_POST['id_danhmuc'] : 0;
            $id_danhmuc = (is_numeric($id_danhmuc) && $id_danhmuc !== '') ? intval($id_danhmuc) : 0;
            $mota = $_POST['mota'] ?? '';
            $price = $_POST['price'] ?? 0;

            // Xử lý ảnh
            if ($img) {
                move_uploaded_file($_FILES['img']['tmp_name'], PATH_ASSETS_UPLOADS . $img);
            }

            // Thêm sản phẩm vào cơ sở dữ liệu
            $this->productModel->addProduct($name, $img, $id_danhmuc, $mota, $price);
            header('Location: '.BASE_URL.'?act=product');
            exit;
        }
    }




    // 🚩🚩🚩🚩🚩🚩 Hàm xử lý bình luận🚩🚩🚩🚩🚩🚩
function Comment(){
    $binhluan = $this->comment->getAllComment1(); // Lấy tất cả bình luận từ model (truyền null nếu không lọc theo id)
    require_once BASE_URL_ADMIN . 'comment.php'; // Đường dẫn tới view quản lý bình luận
}
function deleteComment(){
    if(isset($_GET['id'])){
        //gọi hàm xóa bình luận trong model
        $this->comment->deleteComment($_GET['id']);
        header('Location: '.BASE_URL.'?act=comment');
        exit;
    }
}


    // 🚩🚩🚩🚩🚩🚩 Hàm quản lý người dùng
    public function User() {
        $users = $this->userModel->getAllUsers(); // Lấy tất cả người dùng từ model
        require_once BASE_URL_ADMIN . 'user.php'; // Đường dẫn tới view quản lý người dùng
    }

    //hàm khóa tai khoản người dùng
    function EditUser(){
        if(isset($_GET['id'])){
           //gọi hàm   cập nhật  trạng thái người dùng khóa nguời dùng
           $lockuser=$this->userModel->lockUser($_GET['id']);
           header('Location: '.BASE_URL.'?act=user');
           exit;
    }
}

    //hàm mở lại tài khoản người dùng
    function OpenUser(){
        if(isset($_GET['id'])){
            $openuser=$this->userModel->openUser($_GET['id']);
            header('Location: '.BASE_URL.'?act=user');
        }
    }

    // hàm phân quyền người dùng
    function ChangeRole(){
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['role'])) {
            $id = $_POST['id'];
            $role = $_POST['role'];
            // Gọi hàm phân quyền trong model
            $this->userModel->changeRole($id, $role);
            header('Location: '.BASE_URL.'?act=user');
            exit;
        }
    }

    

}

?>
