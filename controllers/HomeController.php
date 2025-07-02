<?php

class HomeController
{
    public $modelHome;

    public function __construct()
    {
        $this->modelHome = new Home(); // Khởi tạo mô hình Home
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Khởi tạo session nếu chưa có
        }
    }

    public function home()
    {
        $listDanhMuc = $this->modelHome->getAllCategories();
        $listProducts = $this->modelHome->getAllProducts();
        $categories = $this->modelHome->getAllCategories();
        $products = [];

        $categories = $this->modelHome->getAllCategories();

        // Nếu không có id trong URL, mặc định lấy danh mục id = 1
        $categoryId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

        // Lấy tối đa 5 sản phẩm theo danh mục
        $products = $this->modelHome->getProductsByCategory($categoryId, 5);
        require_once './views/home/home.php'; 
    }
    public function viewProductDetail()
    {
        // Kiểm tra xem ID sản phẩm có tồn tại và hợp lệ không
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            echo "<p>Invalid product ID.</p>";
            return;
        }

        // Lấy ID sản phẩm
        $productId = intval($_GET['id']);

        // Gọi model để lấy thông tin sản phẩm
        $product = $this->modelHome->productDetail();
        $productDetails = $this->modelHome->getProductDetails($productId);

        // Kiểm tra nếu sản phẩm tồn tại
        if ($product) {
            // Hiển thị trang chi tiết sản phẩm
            // var_dump($productDetails); die();
            require_once './views/product/product_details.php';
        } else {
            // Thông báo nếu sản phẩm không tìm thấy
            echo "<p>Product not found.</p>";
        }
    }


    public function listDanhMuc()
    {
        $listDanhMuc = $this->modelHome->getAllCategories();
        require_once './views/admin.php';
    }

    public function aboutUs(){
        require_once './views/more/about_us.php';
    }
    public function contact()
    {
        require_once './views/more/contact.php';
    }

    public function dangki()
    {
        require_once './views/login/dangki.php';
    }
    

    public function xldangki()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // var_dump($_POST);die;
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $so_dien_thoai = $_POST['so_dien_thoai'];

            $avata = $_FILES['avata'] ?? null;

            $file_thumb = uploadFile($avata, './uploads/');

            $mat_khau = $_POST['mat_khau'];
            $dia_chi = $_POST['dia_chi'];

            $trang_thai_id = 1 ;
            $chuc_vu_id = 2 ;

            $this->modelHome->addtaiKhoan($ho_ten,$email, $ngay_sinh, $so_dien_thoai, $file_thumb, $mat_khau,$dia_chi, $trang_thai_id,$chuc_vu_id);

            header("Location: ?act=login");
        }
       
    }
    
}
