
<?php 
// trang xử lý các yêu cầu liên quan đến quản trị viên

class AdminController {
    public $category;
    public $productModel;
    public function __construct() {
        if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
            header('Location: '.BASE_URL.'?act=login');
            exit;
        }
        // Khởi tạo model nếu cần
        $this->category = new CategoryModel(); // Giả sử có model CategoryModel để quản lý danh mục
        //  khởi tạo đối tượng model sản phẩm
        $this->productModel = new ProductModel(); // Giả sử có model ProductModel để quản lý sản phẩm
    }

    // Hàm xử lý trang quản trị viên
    public function HomeAdmin() {
        // Logic để lấy dữ liệu cần thiết cho trang quản trị viên
        // Ví dụ: lấy danh sách người dùng, sản phẩm, v.v.
        
        // Gọi view quản trị viên
        require_once BASE_URL_ADMIN . 'homeAD.php'; // Đường dẫn tới view quản trị viên
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

            //truyền vào hàm duyệt   tất cả danh mục trong trường   danh mục khi ko nhấn sửa  để hiển thị
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


    //🚩hàm hiển thị  tất cả 
    function Product(){
        $product=$this->productModel->getAllSP();
        //Hiển thị danh sách sản phẩm ra 
        require_once BASE_URL_ADMIN . 'product.php'; // Đường dẫn tới view quản lý sản phẩm
    }
    
    
}

?>
