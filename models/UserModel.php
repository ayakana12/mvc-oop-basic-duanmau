<?php 
// trang lấy dữ liệu từ người dùng trong database


class UserModel{
    // Kết nối đến cơ sở dữ liệu
    public $conn;
    public function __construct(){
        $this->conn = connectDB();
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


}
?>