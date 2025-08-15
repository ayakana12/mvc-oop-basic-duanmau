<?php 
// trang lấy dữ liệu từ người dùng trong database


class UserModel{
    // Kết nối đến cơ sở dữ liệu
    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    function getAllUsers() {
        $sql = "SELECT * FROM user";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUser($username,$password){
        $sql='SELECT * FROM user WHERE name=:username and pass=:password';
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':password',$password);
        $stmt->execute();
        $user=$stmt->fetch(PDO::FETCH_ASSOC);

        if(!$user){
            echo "Không tìm thấy người dùng. Kiểm tra tên đăng nhập và mật khẩu.";
            exit();
        }

        // Kiểm tra trạng thái tài khoản
        if($user['status'] == 0){
            echo "Tài khoản đã bị khóa. Vui lòng liên hệ admin!";
            exit();
        }

        if($user['role']==1){
            // Nếu là admin, lưu thông tin vào session
            $_SESSION['user'] = $user;
            return 'admin';
        }else{
            // Nếu là người dùng bình thường, lưu thông tin vào session
            $_SESSION['user'] = $user;
            return 'user';
        }
    }

    // hàm kiểm tra email đã tồn tại
    public function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM user WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // hàm thêm người dùng
    public function addUser($name, $email, $pass, $avatar, $address) {
        $sql = "INSERT INTO user (name, email, pass, avata, address, create_at) VALUES (:name, :email, :pass, :avatar, :address, :create_at)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':address', $address);
        $create_at = date('Y-m-d H:i:s');
        if ($avatar && $avatar['error'] == UPLOAD_ERR_OK) {
            // Kiểm tra và xử lý upload ảnh
            $targetDir = 'uploads/img'; // Thư mục lưu trữ ảnh
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            } 
            $targetFile = $targetDir . basename($avatar['name']);
            move_uploaded_file($avatar['tmp_name'], $targetFile);//di chuyển file ảnh mà người dùng vừa upload từ thư mục tạm (tmp_name) sang thư mục đích ($targetFile) trên server.
            $stmt->bindParam(':avatar', $targetFile);
            $stmt->bindParam(':create_at', $create_at);
        } else {
            $stmt->bindValue(':avatar', null); // Nếu không có ảnh, gán giá trị null
            $stmt->bindParam(':create_at', $create_at);
        }
        $stmt->execute();
    }

    // Hàm cập nhật nếu người duing bị khóa
    public function lockUser($id) {
        $sql = "UPDATE user SET status = 0 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    //hàm mở lại tài khoản người dùng
    public function openUser($id) {
        $sql = "UPDATE user SET status = 1 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // hàm phân quyền người dùng
    public function changeRole($id, $role) {
        $sql = "UPDATE user SET role = :role WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Hàm cập nhật thông tin người dùng
    public function updateUser($id, $name, $email, $address, $avatar, $pas = null) {
    $sql = "UPDATE user SET name = :name, email = :email, address = :address, avata = :avatar, pass=:pass WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    // Đảm bảo address không null
    $address = $address ?? '';
    $stmt->bindParam(':address', $address);
        if ($pas) {
            $stmt->bindParam(':pass', $pas);
        } else {
            $stmt->bindValue(':pass', null); // Nếu không có mật khẩu mới, gán giá trị null
        }
       
        if (is_array($avatar) && isset($avatar['error']) && $avatar['error'] == UPLOAD_ERR_OK) {
            $targetDir = 'uploads/img/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $targetFile = $targetDir . basename($avatar['name']);
            move_uploaded_file($avatar['tmp_name'], $targetFile);
            $stmt->bindParam(':avatar', $targetFile);
        } else {
            $stmt->bindValue(':avatar', null);
        }
        return $stmt->execute();
    }

    // Hàm xóa người dùng
    public function deleteUser($id) {
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }


}
?>