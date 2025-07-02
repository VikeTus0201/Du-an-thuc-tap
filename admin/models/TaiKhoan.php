<?php
class TaiKhoan{
    public $conn;

    public function __construct(){
        $this->conn = connectDB();
    }

    public function getAllTaiKhoan(){
        try{
            $sql = 'SELECT * FROM tai_khoans ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        }catch (PDOException $e){
            echo 'loi: '.$e->getMessage();
        }
    }

    //khuyen mai 

    public function getAllkhuyenmai(){
        try{
            $sql = 'SELECT * FROM khuyen_mais ' ;

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        }catch (PDOException $e){
            echo 'loi: '.$e->getMessage();
        }
    }


    public function getAllTaiKhoankhachhang($chuc_vu_id){
        try{
            $sql = 'SELECT * FROM tai_khoans  WHERE chuc_vu_id = :chuc_vu_id' ;

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':chuc_vu_id'=>$chuc_vu_id]);

            return $stmt->fetchAll();
        }catch (PDOException $e){
            echo 'loi: '.$e->getMessage();
        }
    }

    // public function posData($ho_ten,$so_dien_thoai, $email, $mat_khau){
    //     try{
    //         // var_dump($ho_ten,$so_dien_thoai, $email, $mat_khau);
    //         // die();
    //         $sql = 'INSERT INTO tai_khoans (ho_ten, email, so_dien_thoai, mat_khau)
    //             VALUES (:ho_ten, :email, :so_dien_thoai, :mat_khau)';
            
    //         $stmt = $this->conn->prepare($sql);


    //         $stmt->bindParam(':ho_ten', $ho_ten);
    //         $stmt->bindParam(':so_dien_thoai',$so_dien_thoai );
    //         $stmt->bindParam(':email', $email);
    //         $stmt->bindParam(':mat_khau', $mat_khau);
    //         // $stmt->bindParam(':chuc_vu_id', $chuc_vu_id);

    //         $stmt->execute();
            

    //         return true;
    //     }catch (PDOException $e){
    //         echo "loi" . $e->getMessage();
    //     }
    // }




    public function posData($ho_ten, $so_dien_thoai, $email, $mat_khau, $dia_chi, $file_thumb, $ngay_sinh, $chuc_vu, $trang_thai ){
        try{
            // var_dump($ho_ten, $so_dien_thoai, $email, $mat_khau, $dia_chi, $avata, $ngay_sinh, $chuc_vu, $trang_thai );
            // die();
            $sql = 'INSERT INTO tai_khoans  (ho_ten,email,so_dien_thoai,mat_khau,dia_chi,avata,ngay_sinh,chuc_vu_id,trang_thai)
             VALUES (:ho_ten,:email,:so_dien_thoai,:mat_khau,:dia_chi,:avata,:ngay_sinh,:chuc_vu_id,:trang_thai)';

            
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':ho_ten', $ho_ten);
            $stmt->bindParam(':email',$email );
            $stmt->bindParam(':so_dien_thoai', $so_dien_thoai);
            $stmt->bindParam(':mat_khau', $mat_khau);
            $stmt->bindParam(':dia_chi', $dia_chi);
            $stmt->bindParam(':avata', $file_thumb);
            $stmt->bindParam(':ngay_sinh', $ngay_sinh);
            $stmt->bindParam(':chuc_vu_id', $chuc_vu);
            $stmt->bindParam(':trang_thai', $trang_thai);
           
            //  var_dump($ho_ten, $so_dien_thoai, $email, $mat_khau, $dia_chi, $file_thumb, $ngay_sinh, $chuc_vu, $trang_thai );
            // die();
            // $stmt->bindParam(':chuc_vu_id', $chuc_vu_id);

            // return $this->conn->lastInsertId();
            $stmt->execute();
            

            
        }catch (PDOException $e){
            echo 'loi: '.$e->getMessage();
        }
    }



    public function posDatakhachhang($ho_ten,$sdt, $email, $password, $chuc_vu_id){
        try{
            // var_dump($name,$sdt, $email, $password, $chuc_vu_id);
            // die();
            $sql = 'INSERT INTO tai_khoans (ho_ten, so_dien_thoai, email, mat_khau, chuc_vu_id)
                VALUES (:ho_ten, :so_dien_thoai, :email, :mat_khau, :chuc_vu_id)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':so_dien_thoai' => $sdt,
                ':email' => $email,
                ':mat_khau' => $password,
                ':chuc_vu_id' => $chuc_vu_id,
            ]);
            

            return true;
        }catch (PDOException $e){
            echo 'loi: '.$e->getMessage();
        }
    }
    
    public function deleteData($id){
        try{
            $sql = 'DELETE FROM `tai_khoans`  WHERE id = :id ' ;

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id',$id);

            $stmt->execute();


            return true;
        }catch (PDOException $e){
            echo 'loi: '.$e->getMessage();
        }
    }



    public function deletekhuyenmai($id){
        try{
            $sql = 'DELETE FROM `khuyen_mais`  WHERE id = :id ' ;

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id',$id);

            $stmt->execute();


            return true;
        }catch (PDOException $e){
            echo 'loi: '.$e->getMessage();
        }
    }



    public function deleteDatakhachhang($id){
        try{
            $sql = 'DELETE FROM `tai_khoans`  WHERE id = :id ' ;

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id',$id);

            $stmt->execute();


            return true;
        }catch (PDOException $e){
            echo 'loi: '.$e->getMessage();
        }
    }

    public function getDeTailData($id){
        try{
            
            $sql = 'SELECT * FROM tai_khoans  WHERE id = :id ' ;

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id',$id);

            $stmt->execute();


            return $stmt->fetch();
        }catch (PDOException $e){
            echo 'loi: '.$e->getMessage();
        }
    }
    public function getDeTailDatakhachhang($id){
        try{
            $sql = 'SELECT * FROM `tai_khoans`  WHERE id = :id ' ;

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id',$id);

            $stmt->execute();


            return $stmt->fetch();
        }catch (PDOException $e){
            echo 'loi: '.$e->getMessage();
        }
    }

    //khuyen mai 

    public function getDeTailDatakhuyenmai($id){
        try{
            $sql = 'SELECT * FROM `khuyen_mais`  WHERE id = :id ' ;

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id',$id);

            $stmt->execute();


            return $stmt->fetch();
        }catch (PDOException $e){
            echo 'loi: '.$e->getMessage();
        }
    }


    //sua quan tri 

    
    public function updateData($id,$ho_ten, $email, $so_dien_thoai, $mat_khau, $trang_thai , $chuc_vu, $dia_chi,$avata, $ngay_sinh){
        try{
            // var_dump($ho_ten, $so_dien_thoai, $email, $mat_khau, $dia_chi, $avata, $ngay_sinh, $chuc_vu, $trang_thai );
            // die();
            $sql = 'UPDATE tai_khoans SET ho_ten = :ho_ten, email = :email, so_dien_thoai = :so_dien_thoai,
             mat_khau = :mat_khau, trang_thai = :trang_thai, chuc_vu_id = :chuc_vu_id, dia_chi = :dia_chi, avata = :avata,
             ngay_sinh = :ngay_sinh
             WHERE id = :id';

            
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':ho_ten', $ho_ten);
            $stmt->bindParam(':so_dien_thoai',$so_dien_thoai );
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mat_khau', $mat_khau);
            $stmt->bindParam(':dia_chi', $dia_chi);
            $stmt->bindParam(':avata', $avata);
            $stmt->bindParam(':ngay_sinh', $ngay_sinh);
            $stmt->bindParam(':chuc_vu_id', $chuc_vu);
            $stmt->bindParam(':trang_thai', $trang_thai);
            
           
            // $stmt->bindParam(':chuc_vu_id', $chuc_vu_id);

            $stmt->execute();
            

            return true;
        }catch (PDOException $e){
            echo "loi" . $e->getMessage();
        }
    }

    //khuyen mai 

    public function uppdateDatakhuyenmai($id, $ma_khuyen_mai, $ten_khuyen_mai, $muc_giam, $so_luong,$ngay_bat_dau,$ngay_ket_thuc,$mo_ta,$trang_thai )
    {
        try{
            // var_dump($id, $ma_khuyen_mai, $ten_khuyen_mai, $muc_giam, $so_luong, $so_luong_ma_mot_nguoi);
            // die();
            $sql = 'UPDATE khuyen_mais SET ma_khuyen_mai = :ma_khuyen_mai, ten_khuyen_mai = :ten_khuyen_mai,
             muc_giam = :muc_giam, so_luong = :so_luong,ngay_bat_dau = :ngay_bat_dau,ngay_ket_thuc = :ngay_ket_thuc,mo_ta = :mo_ta,trang_thai = :trang_thai
              WHERE id = :id';

            
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':ma_khuyen_mai', $ma_khuyen_mai);
            $stmt->bindParam(':ten_khuyen_mai',$ten_khuyen_mai );
            $stmt->bindParam(':muc_giam', $muc_giam);
            $stmt->bindParam(':so_luong', $so_luong);
            $stmt->bindParam(':ngay_bat_dau', $ngay_bat_dau);
            $stmt->bindParam(':ngay_ket_thuc', $ngay_ket_thuc);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->bindParam(':trang_thai', $trang_thai);
           
            // $stmt->bindParam(':chuc_vu_id', $chuc_vu_id);

            $stmt->execute();
            

            return true;
        }catch (PDOException $e){
            echo "loi" . $e->getMessage();
        }
    }


    //khach hang

    public function uppdateDatakhachhang($id,$ho_ten,$so_dien_thoai, $email){
        try{
            // var_dump($ho_ten,$so_dien_thoai, $email, $mat_khau, $chuc_vu_id);
            // die();
            $sql = 'UPDATE tai_khoans SET ho_ten = :ho_ten, so_dien_thoai = :so_dien_thoai,
             email = :email WHERE id = :id';

            
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':ho_ten', $ho_ten);
            $stmt->bindParam(':so_dien_thoai',$so_dien_thoai );
            $stmt->bindParam(':email', $email);
           
            // $stmt->bindParam(':chuc_vu_id', $chuc_vu_id);

            $stmt->execute();
            

            return true;
        }catch (PDOException $e){
            echo "loi" . $e->getMessage();
        }
    }

    //khuyen mai 

    public function addkhuyenmai( $ma_khuyen_mai, $ten_khuyen_mai, $muc_giam, $so_luong,$ngay_bat_dau,$ngay_ket_thuc,$mo_ta,$trang_thai){
        try{
            // var_dump( $ma_khuyen_mai, $ten_khuyen_mai, $muc_giam, $so_luong, $so_luong_ma_mot_nguoi);
            // die();
            $sql = 'INSERT INTO khuyen_mais  (ma_khuyen_mai,ten_khuyen_mai,muc_giam, so_luong , ngay_bat_dau,ngay_ket_thuc,mo_ta,trang_thai)
             VALUES (:ma_khuyen_mai,:ten_khuyen_mai,:muc_giam, :so_luong ,:ngay_bat_dau,:ngay_ket_thuc,:mo_ta,:trang_thai)';

            
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':ma_khuyen_mai', $ma_khuyen_mai);
            $stmt->bindParam(':ten_khuyen_mai',$ten_khuyen_mai );
            $stmt->bindParam(':muc_giam', $muc_giam);
            $stmt->bindParam(':so_luong', $so_luong);
            $stmt->bindParam(':ngay_bat_dau', $ngay_bat_dau);
            $stmt->bindParam(':ngay_ket_thuc', $ngay_ket_thuc);
            $stmt->bindParam(':mo_ta', $mo_ta);
            $stmt->bindParam(':trang_thai', $trang_thai);
           
            // $stmt->bindParam(':chuc_vu_id', $chuc_vu_id);

            $stmt->execute();
            

            return true;
        }catch (PDOException $e){
            echo 'loi: '.$e->getMessage();
        }
    }
    

    public function __destruct(){
        $this->conn = null;
    }

   


}

?>