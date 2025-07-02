<?php

class TrangThai
{
    public $conn;

    //kết nối CSDL

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy danh sách đơn hàng
    public function getAllOrders()
    {
        try {
            $sql = 'SELECT * FROM don_hangs ORDER BY id DESC';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }


    // // Cập nhật trạng thái đơn hàng
    public function updateOrderStatus($orderId, $statusId)
    {
        $sql = "UPDATE don_hangs SET trang_thai_id = :status_id WHERE id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status_id', $statusId, PDO::PARAM_INT);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        return $stmt->execute();
    }



}