<?php
//trang quan lý danh mục sản phẩm
class CategoryModel {

    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }

    // Lấy tất cả danh mục
    function getAllCategories() {
        $sql = "SELECT * FROM danhmuc";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy danh mục theo ID
    function getCategoryById($id) {
        $sql = "SELECT * FROM danhmuc WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //thực hiện thêm danh mục
    function addCategory($name, $quantily) {
        $sql = "INSERT INTO danhmuc (name, quantily) VALUES (:name, :quantily)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':quantily', $quantily);
        return $stmt->execute();
    }
    //thực hiện sửa danh mục
    function updateCategory($id, $name, $quantily) {
        $sql = "UPDATE danhmuc SET name = :name, quantily = :quantily WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':quantily', $quantily);
        return $stmt->execute();
    }
    
    //hm xóa danh mục
    function deleteCategory($id) {
        $sql = "DELETE FROM danhmuc WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
} 
?>