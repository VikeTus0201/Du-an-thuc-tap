<?php

class DanhMucController
{
    //kết nối đến fite model
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelDanhMuc = new DanhMuc();
    }
    //hàm hiển thị form thêm
    public function index(){
        
        //lấy ra dữ liệu danh mục
        $danhMucs = $this->modelDanhMuc->getAll();
     //   var_dump($danhMucs);

        //đưa dữ liệu ra view
        require_once './views/danhmuc/list_danh_muc.php';
    }

    //hàm hiển thị form thêm
    public function create(){
        require_once './views/danhmuc/create_danh_muc.php';

    }

     //hàm sử lý thêm vào CSDL
     public function store(){
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            //lấy ra dữ liệu
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            //validate
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục là bắt buộc';

            }

            if (empty($mo_ta)) {
                $errors['mo_ta'] = 'Mô tả là bắt buộc';
                
        }
          
        //thêm dữ liệu
        if (empty($errors)) {
            //nếu ko có lỗi thì thêm dữ liệu
            //thêm vào csdl
            $this->modelDanhMuc->postData($ten_danh_muc,$mo_ta);
            unset($_SESSION['errors']);
            header('location: ?act=danh-mucs');
            exit();
        }else{
            $_SESSION['errors'] = $errors;
            header('location: ?act=form- them-danh-muc');
            exit();

        }
     }
    }

      //hàm hiển thị form chỉnh sửa
    public function edit(){
        //lấy id
        $id = $_GET['danh_muc_id'];
        //lấy thông tin chi tiết của danh mục
        $danhMuc = $this->modelDanhMuc->getDetailData($id);

       //đổ dữ liệu ra form
       require_once './views/danhmuc/edit_danh_muc.php';

    }

     //hàm sử lý cập nhật dữ liệu vào CSDL
     public function update(){
       
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                //lấy ra dữ liệu
                $id = $_POST['id'];
                $ten_danh_muc = $_POST['ten_danh_muc'];
                $mo_ta = $_POST['mo_ta'];
                
    
                //validate
                $errors = [];
                if (empty($ten_danh_muc)) {
                    $errors['ten_danh_muc'] = 'tên danh mục là bắt buộc';
    
                }
                if (empty($mo_ta)) {
                    $errors['mo_ta'] = 'mo ta là bắt buộc';
    
                }
    
                
    
            //thêm dữ liệu
            if (empty($errors)) {
                //nếu ko có lỗi thì thêm dữ liệu
                //thêm vào csdl
                $this->modelDanhMuc->updateData($id,$ten_danh_muc, $mo_ta);
                unset($_SESSION['errors']);
                header('location: ?act=danh-mucs');
                exit();
            }else{
                $_SESSION['errors'] = $errors;
                header('location: ?act=form-sua-danh-muc');
                exit();
    
            }
         }
        
    
        
     }

      //hàm xóa dữ liệu trong CSDL
    public function destroy(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['danh_muc_id'];
            
            //xóa danh mục
           $deleteDanhMuc = $this->modelDanhMuc->deleteData($id);

           header('location: ?act=danh-mucs');
           exit();
        }

    }
  
}