<?php

class Products
{
    private $db;

    public function __construct()
    {
        $this->db = connectDB(); // Khởi tạo đối tượng kết nối cơ sở dữ liệu
    }

    // Lấy tất cả sản phẩm
    public function getAllProducts()
    {
        $query = "SELECT * FROM san_phams";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy sản phẩm theo ID
    public function getProductById($id)
    {
        $query = "SELECT * FROM san_phams WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Lấy ra danh mục sản phẩm
    public function getAllCategories()
    {
        $query = "SELECT * FROM danh_mucs";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getDanhMuc($id)
    {
        $query = "SELECT * FROM danh_mucs WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy danh sách sản phẩm theo danh mục và giới hạn số lượng
    public function getProductsByCategory($categoryId)
    {
        // Ép kiểu $limit thành số nguyên để đảm bảo an toàn

        // Sử dụng LIMIT trực tiếp trong câu truy vấn
        $query = "SELECT * FROM san_phams WHERE danh_muc_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getAllDonHang()
    // {
    //     $query = "SELECT * FROM don_hang";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute();
    //     return $stmt->fetchAll();
    // }


    // Lấy thông tin sản phẩm
    public function getProductDetails($product_id)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM san_phams WHERE id = ?");
        $stmt->execute([$product_id]);
        return $stmt->fetch();
    }

    // Lấy thông tin chi tiết sản phẩm (màu, kích thước, v.v.)
    public function getProductDetailsForView($product_id)
    {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM chi_tiet_san_phams WHERE san_pham_id = ?");
        $stmt->execute([$product_id]);
        return $stmt->fetchAll();
    }

    // Tìm kiếm sản phẩm theo từ khóa
    public function searchProducts($searchQuery)
    {
        $query = "SELECT * FROM san_phams WHERE ten_san_pham LIKE :searchQuery";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
