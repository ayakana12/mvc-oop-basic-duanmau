    
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
    function getSearch($category, $keyword){
        if ($category === '' || $category === null) {
            // Không lọc theo danh mục, chỉ tìm theo tên
            $sql = "SELECT * FROM product WHERE name LIKE :tk";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':tk', '%' . $keyword . '%');
        } else {
            // Lọc cả danh mục và tên
            $sql = "SELECT * FROM product WHERE id_danhmuc = :category AND name LIKE :tk";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':category', $category);
            $stmt->bindValue(':tk', '%' . $keyword . '%');
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // 🚩🚩🚩🚩🚩🚩 Hàm xóa  sản phẩm
    function deleteProduct($id){
        $sql = "DELETE FROM product WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // 🚩🚩🚩🚩🚩🚩 Hàm thêm sản phẩm

    function getImgById($id){
        $sql="SELECT img FROM product WHERE id=:id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $ketqua=$stmt->fetch(PDO::FETCH_ASSOC);
        return $ketqua['img'];
    }
    // cập nhật sản phẩm (chỉ sửa các trường có trong form sửa)
    function updateProduct($id, $name, $img, $id_danhmuc, $mota, $price){
        $sql = "UPDATE product SET name = :name, img = :img, id_danhmuc = :id_danhmuc, mota = :mota, price = :price WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':id_danhmuc', $id_danhmuc, PDO::PARAM_INT);
        $stmt->bindParam(':mota', $mota);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    // 🚩🚩🚩🚩🚩🚩 Hàm thêm sản phẩm
    function addProduct($name, $img, $id_danhmuc, $mota, $price){
        $sql = "INSERT INTO product (name, img, id_danhmuc, mota, price) VALUES (:name, :img, :id_danhmuc, :mota, :price)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':id_danhmuc', $id_danhmuc);
        $stmt->bindParam(':mota', $mota);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

}
