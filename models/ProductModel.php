<?php 
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
//file model lấy  sản phẩm từ database
class ProductModel {
    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }

    // Viết truy vấn danh sách sản phẩm 
     function getAllSP(){
        $sql= "SELECT product.*,  danhmuc.name AS tendanhmuc from product inner join danhmuc on product.id_danhmuc=danhmuc.id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        $ketqua=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $ketqua;
    }

     //lấy thông tin chi tiêt sản phẩm
    function getSPById($id){
        $sql= "SELECT product.*, danhmuc.name AS tendanhmuc FROM product INNER JOIN danhmuc ON product.id_danhmuc=danhmuc.id WHERE product.id=:id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $ketqua=$stmt->fetch(PDO::FETCH_ASSOC);
        return $ketqua;
    }
    // hàm lấy  sản phẩm ngẫu nhiên
    function getproductsrandom($product,$limit){
        $limit = intval($limit); // Đảm bảo là số nguyên
        $sql="SELECT * from product where id != :id ORDER  BY RAND() LIMIT $limit"; 
        $stmt=$this->conn->prepare($sql);
        $stmt->execute(['id'=>$product] );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hàm tìm kiếm sản phẩm
    function getSearch($name,$tk){
        $sql="SELECT * FROM product WHERE id_danhmuc=:name AND name LIKE :tk";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(':name',$name);
        $stmt->bindValue(':tk', '%' . $tk . '%'); // Thêm dấu % để tìm kiếm theo từ khóa
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }


}
