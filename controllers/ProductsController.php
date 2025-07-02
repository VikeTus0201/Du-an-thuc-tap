<?php

class ProductsController
{
    public $modelProducts;

    public function __construct()
    {
        $this->modelProducts = new Products(); // Khởi tạo mô hình Products
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Khởi tạo session nếu chưa có
        }
    }

    public function productsList()
    {
        $listDanhMuc = $this->modelProducts->getAllCategories();
        $listProducts = $this->modelProducts->getAllProducts();
        $categories = $this->modelProducts->getAllCategories();
        $products = [];

        $categories = $this->modelProducts->getAllCategories();

        // Nếu không có id trong URL, mặc định lấy danh mục id = 1
        $categoryId = isset($_GET['id']) ? (int)$_GET['id'] : null;

        // 

        $searchQuery = isset($_GET['q']) ? trim($_GET['q']) : null;
        $categoryId = isset($_GET['id']) ? $_GET['id'] : null;

        if($searchQuery){
            $products = $this->modelProducts->searchProducts($searchQuery);
        } elseif ($categoryId){
            $products = $this->modelProducts->getProductsByCategory($categoryId);
        }
        elseif(!isset($searchQuery) || $searchQuery === ''){
            $products = $this->modelProducts->getAllProducts();
        }



        require_once './views/product/products.php'; // Hiển thị danh sách sản phẩm
    }

    // public function listDanhMuc()
    // {
    //     $categories  = $this->modelProducts->getAllDanhMuc();
    //     require_once './views/admin.php';
    // }
    // public function viewProducts()
    // {
    //     $productModel = new Product();
    //     $categoryModel = new Category();
    //     $categories = $categoryModel->getAllCategories();

    //     $searchQuery = isset($_GET['q']) ? trim($_GET['q']) : null;
    //     $categoryId = isset($_GET['id']) ? $_GET['id'] : null;

    //     if ($searchQuery) {
    //         // Nếu có từ khóa tìm kiếm, lấy danh sách sản phẩm tìm kiếm
    //         $products = $productModel->searchProducts($searchQuery);
    //     } elseif ($categoryId) {
    //         // Nếu có id danh mục, lấy danh sách sản phẩm theo danh mục
    //         $products = $productModel->getProductsByCategoryId($categoryId);
    //     } else {
    //         // Nếu không có gì, lấy toàn bộ sản phẩm
    //         $products = $productModel->getAllProducts();
    //     }

    //     require_once './views/product/product.php';
    // }

}