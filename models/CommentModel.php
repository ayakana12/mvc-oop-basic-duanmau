<?php
// bắt đầu phiên làm việc lấy dữ liệu comment từ người dùng

class Comment {

    //kết nôi đến cơ sở dữ liệu
    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }


    // Hàm lấy toàn bộ comment kèm tên và avatar user
    function getAllComment($id) {
         $sql = "SELECT comment.*, user.name AS name, user.avata AS avata FROM comment inner JOIN user ON comment.id_user = user.id WHERE comment.id_sp = :id ORDER BY comment.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    function getAllComment1() {
         $sql = "SELECT comment.*, user.name AS name, user.avata AS avata , product.name AS product_name
         FROM comment 
          inner JOIN user ON comment.id_user = user.id
          inner  Join product on comment.id_sp = product.id
         ORDER BY comment.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //🚩🚩 Hàm sử lý  hàm thêm bình luận
    function addComment ($id_sp, $content,$id_user){
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO comment (id_sp, id_user, date, noidung) VALUES (:id_sp, :id_user, :date, :noidung)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_sp', $id_sp);
        $stmt->bindParam(':id_user', $id_user); // cần truyền biến $user_id vào hàm
           $stmt->bindParam(':date', $date);
        $stmt->bindParam(':noidung', $content);
        
     
        return $stmt->execute();
    }

    function deleteComment($id){
        $sql="DELETE FROM comment WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

}
?>