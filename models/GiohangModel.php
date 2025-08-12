   
<?php
class GioHang {
    // Kết nối đến cơ sở dữ liệu
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // Hàm thêm sản phẩm vào giỏ hàng
    public function addToCart($product_id, $id_user) {
        $sql = "INSERT INTO giohang (product_id, user_id, create_at) VALUES (:product_id, :user_id, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':user_id', $id_user);
      
        return $stmt->execute();
    }

    // Hàm lấy giỏ hàng của người dùng
    public function getCart($id_user) {
        $sql = "SELECT giohang.*, product.name AS product_name, product.img AS product_img, product.price AS product_price FROM giohang INNER JOIN product ON giohang.product_id = product.id WHERE giohang.user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $id_user);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Hàm xóa sản phẩm khỏi giỏ hàng
    public function deleteFromCart($id, $id_user) {
        $sql = "DELETE FROM giohang WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $id_user);
        return $stmt->execute();
    }
    
}
?>