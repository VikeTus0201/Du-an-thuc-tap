<?php
class TaiKhoanController{
    

    public $modelTaiKhoan;

    public function __construct(){
        $this->modelTaiKhoan = new TaiKhoan();
    }

    public function index_taikhoan(){
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan();
        // var_dump($listQuanTri);
        
        require_once './views/quantri/listQuanTri.php';
    }

    // public function danhsachkhachhang(){
    //     $listkhachhang = $this->modelTaiKhoan->getAllTaiKhoankhachhang(2);
    //     // var_dump($listQuanTri);

    //     require_once './views/khachhang/listkhachhang.php';
    // }


    public function formAddQuanTri(){
       

        require_once './views/quantri/FormThemQuanTri.php';
        
    }
    public function postAddQuanTri(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            
            $ho_ten = $_POST['ho_ten'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $email = $_POST['email'];
            $mat_khau = $_POST['mat_khau'];
            $dia_chi = $_POST['dia_chi'];

            $avata = $_FILES['avata'] ?? null;

            $file_thumb = uploadFile($avata, './admin/uploads/');

            // $img_array = $_FILES['img_array'];

            $ngay_sinh = $_POST['ngay_sinh'];
            $chuc_vu = $_POST['chuc_vu'];
            $trang_thai = $_POST['trang_thai'];
            
            

            $errors = [];
            if (empty($ho_ten)){
                $errors['ho_ten'] = 'Name la bat buoc';
            }
            if (empty($so_dien_thoai)){
                $errors['so_dien_thoai'] = 'SDT la bat buoc';
            }
            if (empty($email)){
                $errors['email'] = 'Email la bat buoc';
            }
            if (empty($dia_chi)){
                $errors['dia_chi'] = 'Dia chi la bat buoc';
            }
            if (empty($avata)){
                $errors['avata'] = 'avata la bat buoc';
            }
            if (empty($ngay_sinh)){
                $errors['ngay_sinh'] = 'ngay sinh la bat buoc';
            }
            // if (empty($chuc_vu)){
            //     $errors['chuc_vu'] = 'chuc vu la bat buoc';
            // }
            if (empty($mat_khau)){
                $errors['mat_khau'] = 'mat khau la bat buoc';
            }
            if (empty($trang_thai)){
                $errors['trang_thai'] = 'trang thai la bat buoc';
            }

            if (empty($errors)) {
                // $mat_khau = password_hash('$mat_khau', PASSWORD_BCRYPT);
                // var_dump($password);die;
                // Khai báo chức vụ
                // $chuc_vu_id = 1;

                // var_dump($ho_ten, $so_dien_thoai, $email, $mat_khau, $dia_chi, $file_thumb, $ngay_sinh, $chuc_vu, $trang_thai);die();

                $this->modelTaiKhoan->posData($ho_ten, $so_dien_thoai, $email, $mat_khau, $dia_chi, $file_thumb, $ngay_sinh, $chuc_vu, $trang_thai );
                
                unset($_SESSION['errors']);
                header('Location: ?act=tai-khoans');
                exit();
                
            }else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=form-them-quan-tri');
                exit();
             }
        }
        
        
    }
    // public function formAddkhachhang(){
       

    //     require_once './views/khachhang/formthemkhachhang.php';
        
    // }

    // public function postAddkhachhang(){
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //         $name = $_POST['name'];
    //         $sdt = $_POST['sdt'];
    //         $email = $_POST['email'];
    //         $password = $_POST['password'];
            

    //         $errors = [];
    //         if (empty($name)){
    //             $errors['name'] = 'Name la bat buoc';
    //         }
    //         if (empty($sdt)){
    //             $errors['sdt'] = 'SDT la bat buoc';
    //         }
    //         if (empty($email)){
    //             $errors['email'] = 'Email la bat buoc';
    //         }

    //         if (empty($errors)) {
    //             $password = password_hash('123@123ab', PASSWORD_BCRYPT);
    //             // var_dump($password)

    //             $this->modelTaiKhoan->posDatakhachhang($name, $sdt, $email, $password, $chuc_vu_id);
    //             unset($_SESSION['errors']);
    //             header('Location: ?act=tai-khoan-khach-hang');
    //             exit();
                
    //         }else {
    //             $_SESSION['errors'] = $errors;
    //             header('Location: ?act=form-them-khach-hang');
    //             exit();
    //         }
    //     }
        
        
    // }

    public function deleteQuanTri(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['quan_tri_id'];
            // var_dump($id);

            $this->modelTaiKhoan->deleteData($id);
            header('Location: ?act=tai-khoans');
            exit();

          
        }
        
    }
    // public function deleteKhachHang(){
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //         $id = $_POST['khach_hang_id'];
    //         // var_dump($id);

    //         $this->modelTaiKhoan->deleteDatakhachhang($id);
    //         header('Location: ?act=tai-khoan-khach-hang');
    //         exit();

          
    //     }
        
    // }

    public function formEditQuanTri(){
        $id= $_GET['quan_tri_id'];
 
        $taiKhoan=$this->modelTaiKhoan->getDeTailData($id);
        
        //do du lieu ra form 
        require_once './views/quantri/FormsuaQuanTri.php';
 
     }
     public function postEditQuanTri(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $_POST['id'];

            $QuanTri = $this->modelTaiKhoan->getDeTailData($id);
            $old_file = $QuanTri['avata'];

            $ho_ten = $_POST['ho_ten'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $email = $_POST['email'];
            $mat_khau = $_POST['mat_khau'];
            $dia_chi = $_POST['dia_chi'];
            $avata = $_FILES['avata'] ;

            $ngay_sinh = $_POST['ngay_sinh'];

            $chuc_vu = $_POST['chuc_vu'] ?? '' ;
            $trang_thai = $_POST['trang_thai'] ?? '' ;
                

            $errors = [];
            if (empty($ho_ten)){
                $errors['ho_ten'] = 'Name la bat buoc';
            }
            if (empty($so_dien_thoai)){
                $errors['so_dien_thoai'] = 'SDT la bat buoc';
            }
            if (empty($email)){
                $errors['email'] = 'Email la bat buoc';
            }
             
           
            if(isset($avata) && $avata['error'] == UPLOAD_ERR_OK){
                $new_file = uploadFile($avata, './admin/uploads/');

                if(!empty($old_file)){
                    deleteFile($old_file);
                }

            }else{
                $new_file = $old_file;
            }

            if (empty($errors)) {

                // var_dump($id, $ho_ten, $email, $so_dien_thoai, $mat_khau, $trang_thai, $chuc_vu, $dia_chi, $new_file, $ngay_sinh); die();
                $this->modelTaiKhoan->updateData($id, $ho_ten, $email, $so_dien_thoai, $mat_khau, $trang_thai, $chuc_vu, $dia_chi, $new_file, $ngay_sinh);
                
                unset($_SESSION['errors']);
                header('Location: ?act=tai-khoans');
                exit();
                
            }else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=form-sua-quan-tri');
                exit();
             }
        }
        
        
    
    
}
    //khach hang

    // public function formEditKhachHang(){
    //     $id= $_GET['khach_hang_id'];
 
    //     $khachhang=$this->modelTaiKhoan->getDeTailDatakhachhang($id);
        
    //     //do du lieu ra form 
    //     require_once './views/khachhang/formsuakhachhang.php';
 
    // }
 
     public function postEditKhachHang(){
         
             if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                 $id = $_POST['id'];
                 $ho_ten = $_POST['ho_ten'];
                 $so_dien_thoai = $_POST['so_dien_thoai'];
                 $email = $_POST['email'];
                 
                 
                 
     
                 $errors = [];
                 if (empty($ho_ten)){
                     $errors['ho_ten'] = 'Name la bat buoc';
                 }
                 if (empty($so_dien_thoai)){
                     $errors['so_dien_thoai'] = 'SDT la bat buoc';
                 }
                 if (empty($email)){
                     $errors['email'] = 'Email la bat buoc';
                 }
     
                 if (empty($errors)) {
                     
     
                     $this->modelTaiKhoan->uppdateDatakhachhang($id,$ho_ten, $so_dien_thoai, $email);
                     
                     unset($_SESSION['errors']);
                     header('Location: ?act=tai-khoan-khach-hang');
                     exit();
                     
                 }else {
                     $_SESSION['errors'] = $errors;
                     header('Location: ?act=form-sua-khach-hang');
                     exit();
                  }
             }
                  
         
     }
//khuyến mãi
     public function danhsachma(){
        $khuyenMais = $this->modelTaiKhoan->getAllkhuyenmai();
        require_once './views/khuyenmai/khuyenmai.php';
     }

    

     public function deletekhuyenmai(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['khuyen_mai_id'];
                // var_dump($id);
    
                $this->modelTaiKhoan->deletekhuyenmai($id);
                header('Location: ?act=khuyen-mais');
                exit();
    
              
            }
            
        }

        public function formEditKhuyenmai(){
            $id= $_GET['khuyen_mai_id'];
     
            $khuyenmai=$this->modelTaiKhoan->getDeTailDatakhuyenmai($id);
            
            //do du lieu ra form 
            require_once './views/khuyenmai/formsuakhuyenmai.php';
     
         }


       
         public function postEditKhuyenmai(){
         
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $id = $_POST['id'];
                $ma_khuyen_mai = $_POST['ma_khuyen_mai'];
                $ten_khuyen_mai = $_POST['ten_khuyen_mai'];
                $muc_giam = $_POST['muc_giam'];
                $so_luong = $_POST['so_luong'];
                $ngay_bat_dau = $_POST['ngay_bat_dau'];
                $ngay_ket_thuc = $_POST['ngay_ket_thuc'];
                $mo_ta = $_POST['mo_ta'];
                $trang_thai = $_POST['trang_thai'];
                
                // var_dump($id);die();
                
    
                $errors = [];
                if (empty($ma_khuyen_mai)){
                    $errors['ma_khuyen_mai'] = 'ma_khuyen_mai la bat buoc';
                }
                if (empty($ten_khuyen_mai)){
                    $errors['ten_khuyen_mai'] = 'ten_khuyen_mai la bat buoc';
                }
                if (empty($muc_giam)){
                    $errors['muc_giam'] = 'muc_giam la bat buoc';
                }
                if (empty($so_luong)){
                    $errors['so_luong'] = 'so_luong la bat buoc';
                }
                if (empty($ngay_bat_dau)){
                    $errors['ngay_bat_dau'] = 'ngay_bat_dau la bat buoc';
                }
                if (empty($ngay_ket_thuc)){
                    $errors['ngay_ket_thuc'] = 'ngay_ket_thuc la bat buoc';
                }
                if (empty($mo_ta)){
                    $errors['mo_ta'] = 'mo_ta la bat buoc';
                }
                if (empty($trang_thai)){
                    $errors['trang_thai'] = 'trang_thai la bat buoc';
                }
    
                if (empty($errors)) {
                    
    
                    $this->modelTaiKhoan-> uppdateDatakhuyenmai($id, $ma_khuyen_mai, $ten_khuyen_mai, $muc_giam, $so_luong,$ngay_bat_dau,$ngay_ket_thuc,$mo_ta,$trang_thai );
                    
                    unset($_SESSION['errors']);
                    header('Location: ?act=khuyen-mais');
                    exit();
                    
                }else {
                    $_SESSION['errors'] = $errors;
                    header('Location: ?act=form-sua-khuyen-mai');
                    exit();
                 }
            }
                 
        
    }

    public function formAddkhuyenmai(){
        require_once './views/khuyenmai/formthemkhuyenmai.php';

     }



    public function Addkhuyenmai(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ma_khuyen_mai = $_POST['ma_khuyen_mai'];
            $ten_khuyen_mai = $_POST['ten_khuyen_mai'];
            $muc_giam = $_POST['muc_giam'];
            $so_luong = $_POST['so_luong'];
            $ngay_bat_dau = $_POST['ngay_bat_dau'];
            $ngay_ket_thuc = $_POST['ngay_ket_thuc'];
            $mo_ta = $_POST['mo_ta'];
            $trang_thai = $_POST['trang_thai'];
            
            // var_dump($ma_khuyen_mai);die();
            

            $errors = [];
            if (empty($ma_khuyen_mai)){
                $errors['ma_khuyen_mai'] = 'ma_khuyen_mai la bat buoc';
            }
            if (empty($ten_khuyen_mai)){
                $errors['ten_khuyen_mai'] = 'ten_khuyen_mai la bat buoc';
            }
            if (empty($muc_giam)){
                $errors['muc_giam'] = 'muc_giam la bat buoc';
            }
            if (empty($so_luong)){
                $errors['so_luong'] = 'so_luong la bat buoc';
            }
            if (empty($ngay_bat_dau)){
                $errors['ngay_bat_dau'] = 'ngay_bat_dau la bat buoc';
            }
            if (empty($ngay_ket_thuc)){
                $errors['ngay_ket_thuc'] = 'ngay_ket_thuc la bat buoc';
            }
            if (empty($mo_ta)){
                $errors['mo_ta'] = 'mo_ta la bat buoc';
            }
            if (empty($trang_thai)){
                $errors['trang_thai'] = 'trang_thai la bat buoc';
            }

            if (empty($errors)) {
                

                $this->modelTaiKhoan->addkhuyenmai( $ma_khuyen_mai, $ten_khuyen_mai, $muc_giam, $so_luong,$ngay_bat_dau,$ngay_ket_thuc,$mo_ta,$trang_thai);
                
                unset($_SESSION['errors']);
                header('Location: ?act=khuyen-mais');
                exit();
                
            }else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=form-them-khuyen-mai');
                exit();
        }
    }
        
             
}

}
     



