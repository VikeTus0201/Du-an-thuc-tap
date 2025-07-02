<?php

class TinTuc 
{
    public $conn;
    //Kết nối CSDL
    public function __construct()
    {
        $this->conn = connectDB();
    }

    //Danh sách tin tức
    public function getAll(){
        try {
            $sql='SELECT* FROM quan_li_tin_tuc';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException$e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    //Thêm dữ liệu mới vào CSDL
    public function postData($ten_tin_tuc, $trang_thai){
        try {
            $sql='INSERT INTO quan_li_tin_tuc(ten_tin_tuc,trang_thai)
                VALUES (:ten_tin_tuc, :trang_thai)';

            $stmt = $this->conn->prepare($sql);

            //Gán giá trị vào các tham số
            $stmt->bindParam(':ten_tin_tuc', $ten_tin_tuc);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->execute();
            return true;
        } catch (PDOException$e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
        //Lấy thông tin chi tiết
        public function getDetailData($id){
            try {
                $sql='SELECT * FROM quan_li_tin_tuc WHERE id= :id';
    
                $stmt = $this->conn->prepare($sql);
                //Gán giá trị vào tham số
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return $stmt->fetch();
            } catch (PDOException$e) {
                echo 'Lỗi: ' . $e->getMessage();
            }
        }
            //Cập nhật dữ liệu mới vào CSDL
    public function updateData($id,$ten_tin_tuc, $trang_thai){
        try {
            $sql='UPDATE quan_li_tin_tuc SET ten_tin_tuc = :ten_tin_tuc, trang_thai = :trang_thai WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            //Gán giá trị vào các tham số
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':ten_tin_tuc', $ten_tin_tuc);
            $stmt->bindParam(':trang_thai', $trang_thai);
            $stmt->execute();
            return true;
        } catch (PDOException$e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    //Xóa dữ liệu trong CSDL
    public function deleteData($id){
        try {
            $sql='DELETE FROM quan_li_tin_tuc WHERE id= :id';

            $stmt = $this->conn->prepare($sql);
            //Gán giá trị vào tham số
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException$e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    //Hủy kết nối CSDL
    public function __destruct()
    {
        $this->conn = null;
    }

}