<?php

class TrangThaiController
{
    //kết nối đến fite model
    public $modelTrangThai;

    public function __construct()
    {
        $this->modelTrangThai = new TrangThai();
    }
    //hàm hiển thị form thêm
    // Hiển thị danh sách đơn hàng
    public function index_trang_thai()
    {
        $donHangs = $this->modelTrangThai->getAllOrders();
        include 'views/trangthai/list_trang_thai.php';
    }

   

  
    public function updateOrderStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['order_id'];
            $statusId = $_POST['status_id'];

            // Cập nhật trạng thái đơn hàng
            if ($this->modelTrangThai->updateOrderStatus($orderId, $statusId)) {
                // Chuyển hướng lại trang danh sách đơn hàng
                header('Location: ./?act=trang-thais');
                exit;
            } else {
                echo "Lỗi cập nhật trạng thái đơn hàng.";
            }
        }
    }
  
}