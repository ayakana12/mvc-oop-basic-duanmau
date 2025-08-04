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
                var_dump($username, $password);
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
    public function addUser($name, $email, $pass,$avatar) {
        $sql = "INSERT INTO user (name, email, pass, avata, create_at) VALUES (:name, :email, :pass, :avatar, :create_at)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $create_at = date('Y-m-d H:i:s');
        if ($avatar && $avatar['error'] == UPLOAD_ERR_OK) {
            // Kiểm tra và xử lý upload ảnh
            $targetDir = 'img/'; // Thư mục lưu trữ ảnh
            $targetFile = $targetDir . basename($avatar['name']);
            move_uploaded_file($avatar['tmp_name'], $targetFile);
            $stmt->bindParam(':avatar', $targetFile);
            $stmt->bindParam(':create_at', $create_at);
        } else {
            $stmt->bindValue(':avatar', null); // Nếu không có ảnh, gán giá trị null
            $stmt->bindParam(':create_at', $create_at);
        }
        $stmt->execute();
    }


}
?>