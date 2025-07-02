<?php

class LienHeController
{
    //kết nối đến fite model
    public $modelLienHe;

    public function __construct()
    {
        $this->modelLienHe = new LienHe();
    }
    //hàm hiển thị form thêm
    public function index_lien_he(){
        
        //lấy ra dữ liệu danh mục
        $lienHes = $this->modelLienHe->getAll();
     //   var_dump($lienHes);

        //đưa dữ liệu ra view
        require_once './views/lienhe/list_lien_he.php';
    }

    //hàm hiển thị form thêm
    public function create_lien_he(){
        require_once './views/lienhe/create_lien_he.php';

    }

     //hàm sử lý thêm vào CSDL
     public function store_lien_he(){
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            //lấy ra dữ liệu
            $ten_lien_he = $_POST['ten_lien_he'];
            $trang_thai_lh = $_POST['trang_thai_lh'];

            //validate
            $errors = [];
            if (empty($ten_lien_he)) {
                $errors['ten_lien_he'] = 'tên liên hệ là bắt buộc';

            }

            if (empty($trang_thai_lh)) {
                $errors['trang_thai_lh'] = 'trạng thái là bắt buộc';
                
        }

        //thêm dữ liệu
        if (empty($errors)) {
            //nếu ko có lỗi thì thêm dữ liệu
            //thêm vào csdl
            $this->modelLienHe->postData($ten_lien_he,$trang_thai_lh);
            unset($_SESSION['errors']);
            header('location: ?act=lien-hes');
            exit();
        }else{
            $_SESSION['errors'] = $errors;
            header('location: ?act=form- them-lien-he');
            exit();

        }
     }
    }

      //hàm hiển thị form chỉnh sửa
    public function edit_lien_he(){
        //lấy id
        $id = $_GET['lien_he_id'];
        //lấy thông tin chi tiết của danh mục
        $lienHe = $this->modelLienHe->getDetailData($id);

       //đổ dữ liệu ra form
       require_once './views/lienhe/edit_lien_he.php';

    }

     //hàm sử lý cập nhật dữ liệu vào CSDL
     public function update_lien_he(){
       
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                //lấy ra dữ liệu
                $id = $_POST['id'];
                $ten_lien_he = $_POST['ten_lien_he'];
                $trang_thai_lh = $_POST['trang_thai_lh'];
    
                //validate
                $errors = [];
                if (empty($ten_lien_he)) {
                    $errors['ten_lien_he'] = 'tên liên hệ là bắt buộc';
    
                }
    
                if (empty($trang_thai_lh)) {
                    $errors['trang_thai_lh'] = 'trạng thái là bắt buộc';
                    
            }
    
            //thêm dữ liệu
            if (empty($errors)) {
                //nếu ko có lỗi thì thêm dữ liệu
                //thêm vào csdl
                $this->modelLienHe->updateData($id,$ten_lien_he,$trang_thai_lh);
                unset($_SESSION['errors']);
                header('location: ?act=lien-hes');
                exit();
            }else{
                $_SESSION['errors'] = $errors;
                header('location: ?act=form-sua-lien-he');
                exit();
    
            }
         }
        
    
        
     }

      //hàm xóa dữ liệu trong CSDL
    public function destroy_lien_he(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['lien_he_id'];
            
            //xóa danh mục
           $deleteLienHe = $this->modelLienHe->deleteData($id);

           header('location: ?act=lien-hes');
           exit();
        }

    }
  
}