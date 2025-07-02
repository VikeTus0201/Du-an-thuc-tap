<?php
class TinTucController 
{
    //Kết nối đến file model
    public $modelTinTuc;

    public function __construct(){
        $this->modelTinTuc = new TinTuc();
    }
    //Hàm hiển thị danh sách
    public function index_tin_tuc(){
        //Lấy ra dữ liệu Tin tức
        $tinTucs = $this->modelTinTuc->getAll();

        //Đưa dữ liệu ra view
        require_once './views/tintuc/list_tin_tuc.php';
    }
    //Hàm hiển thị form thêm
    public function create_tin_tuc(){
        require_once './views/tintuc/create_tin_tuc.php';

    }
    //Hàm xử lí thêm vào CSDL
    public function store_tin_tuc(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Lấy ra dữ liệu
            $ten_tin_tuc   = $_POST['ten_tin_tuc'];
            $trang_thai   = $_POST['trang_thai'];

            //validate
            $errors = [];
            if (empty($ten_tin_tuc)) {
                $errors['ten_tin_tuc'] = 'Tên tin tức không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái không được để trống';
            }

            //Thêm dữ liệu
            if (empty($errors)) {
               //Nếu không có lỗi thì thêm dữ liệu
               //Thêm vào CSDL
               $this->modelTinTuc->postData($ten_tin_tuc, $trang_thai);
               unset( $_SESSION['errors']);
               header('Location: ?act=tin-tucs');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=form-them-tin-tuc');
                exit();
            }


        }
    }
    //Hàm hiển thị form sửa

    public function edit_tin_tuc(){
        //Lấy ID
        $id = $_GET['tin_tuc_id'];
        //Lấy thông tin chi tiết của danh mục
        $tinTuc = $this->modelTinTuc->getdetailData($id);
         //Đổ dữ liệu ra form
         require_once './views/tintuc/edit_tin_tuc.php';

    }
    //Hàm xử lí cập nhật dữ liệu vào CSDL
    public function update_tin_tuc(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Lấy ra dữ liệu
            $id = $_POST['id'];
            $ten_tin_tuc   = $_POST['ten_tin_tuc'];
            $trang_thai   = $_POST['trang_thai'];

            //validate
            $errors = [];
            if (empty($ten_tin_tuc)) {
                $errors['ten_tin_tuc'] = 'Tên tin tức không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái không được để trống';
            }

            //Thêm dữ liệu
            if (empty($errors)) {
               //Nếu không có lỗi thì thêm dữ liệu
               //Thêm vào CSDL
               $this->modelTinTuc->updateData($id,$ten_tin_tuc, $trang_thai);
               unset( $_SESSION['errors']);
               header('Location: ?act=tin-tucs');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=form-sua-tin-tuc');
                exit();
            }


        }
    }
    //Hàm xóa dữ liệu trong CSDL
    public function destroy_tin_tuc(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['tin_tuc_id'];
        //Xóa danh mục
        $this->modelTinTuc->deleteData($id);
        header('Location: ?act=tin-tucs');
        exit();
    }
}
    
}