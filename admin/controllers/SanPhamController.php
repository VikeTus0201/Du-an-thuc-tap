<?php
class SanPhamController
{

    public $modelSanPham;
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelDanhMuc = new DanhMuc();
    }

    public function listSanPham()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        // var_dump($listQuanTri);

        require_once './views/sanpham/listsanpham.php';
    }

    public function formaddSanPham()
    {

        $listDanhMuc = $this->modelDanhMuc->getAll();
        deleteSessionError();
        require_once './views/sanpham/formthemsanpham.php';
    }

    public function postAddSanPham()
    {
        //hàm này dùng để xử lý thêm dữ liệu


        // kiểm tra xem dữ liệu có phải đc subimt lên ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            //  = $_POST['ma_san_pham'] ?? '';
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $hinh_anh = $_POST['hinh_anh'] ?? '';
            // $luot_xem = $_POST['luot_xem'] ?? '' ;

            $gia_nhap =(float) $_POST['gia_nhap'] ?? '';

            $gia_ban = (float)$_POST['gia_ban'] ?? '';
            $gia_khuyen_mai = (float)$_POST['gia_khuyen_mai'] ?? '';
            // $so_luong = (int)$_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            // $trang_thai = $_POST['trang_thai'] ?? '' ;
            $mo_ta = $_POST['mo_ta'] ?? '';
            // $mo_ta_chi_tiet = $_POST['mo_ta_chi_tiet'] ?? '' ;

            $hinh_anh = $_FILES['hinh_anh'] ?? '';

            // var_dump();
            // die();


            // lưu hình ảnh vào 
            $file_thumb = uploadFile($hinh_anh, './admin/uploads/');


            // mảng hình ảnh
            // $img_array = $_FILES['img_array'];


            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];

            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            }
            if (empty($gia_ban)) {
                $errors['gia_ban'] = 'Gia ban không được để trống';
            }
            if (empty($gia_khuyen_mai)) {
                $errors['gia_khuyen_mai'] = 'Gia ban không được để trống';
            }
            if (empty($mo_ta)) {
                $errors['mo_ta'] = 'Mo ta không được để trống';
            }

            // if (empty($so_luong)) {
            //     $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
            // }
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để trống';
            }
            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Danh mục sản phẩm phải chọn';
            }
            // if (empty($trang_thai)) {
            //     $errors['trang_thai'] = 'Trạng thái sản phẩm phải chọn';
            // }

            if ($hinh_anh['error'] !== 0) {
                $errors['hinh_anh'] = 'Phải chọn ảnh sản phẩm';
            }
            // var_dump($gia_khuyen_mai);
            // die();

            $_SESSION['error'] = $errors;


            // nếu ko có lỗi thì tiến hành thêm sản phẩm
            if (empty($errors)) {
                // nếu ko có lỗi thì tiến hàng thêm sản phẩm
                // var_dump('ok');
                

                $san_pham_id = $this->modelSanPham->insertSanPham(
                    $ten_san_pham,

                    $gia_nhap,
                    $gia_ban,
                    $gia_khuyen_mai,
                  
                    $ngay_nhap,
                    $danh_muc_id,

                    $mo_ta,

                    $file_thumb
                );
                // var_dump($san_pham_id);die();
                // xử lý thêm album ảnh sản phẩm img_array
                // if (!empty($img_array['name'])) {
                //     foreach ($img_array['name'] as $key=>$value){
                //         $file = [
                //             'name' => $img_array['name'][$key],
                //             'type' => $img_array['type'][$key],
                //             'tmp_name' => $img_array['tmp_name'][$key],
                //             'error' => $img_array['error'][$key],
                //             'size' => $img_array['size'][$key],
                //         ];

                //         $link_hinh_anh = uploadFile($file, './admin/uploads/');

                //         $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
                //     }
                // }                                


                header('location: ?act=san-phams');
                exit();
            } else {
                //Trả về form và lỗi 
                // Đặt chỉ thị xóa section sau khi hiển thị form
                $_SESSION['flash'] = true;

                header('location: ?act=form-them-san-pham');
                exit();
            }
        }
    }

    public function formEditSanPham()
    {

        // if (!isset($_SESSION['user_admin'])) {
        //     header('Location: ' . BASE_URL_ADMIN . '?act=login-admin');
        //     exit();
        // }
        //hàm này dùng để hiện thi form nhập
        // lấy ra thông tin của sản phẩm cần sủa
        $id = $_GET['id_san_pham'];
        $SanPham = $this->modelSanPham->getDetailSanPham($id);
        // $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listDanhMuc = $this->modelDanhMuc->getAll();
        if ($SanPham) {
            deleteSessionError();
            
            require_once './views/sanpham/editsanpham.php';
        } else {
            header('location: ?act=san-phams');
            exit();
        }
    }


    public function postEditSanPham()
    {
        //hàm này dùng để xử lý thêm dữ liệu


        // kiểm tra xem dữ liệu có phải đc subimt lên ko
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            // lấy ra dữ liệu cũ của ảnh sản phẩm
            $san_pham_id = $_POST['san_pham_id'] ?? '';
            // var_dump($san_pham_id);die();
            // Truy vấn
            $SanPhamOld = $this->modelSanPham->getDetailSanPham($san_pham_id);
            $old_file = $SanPhamOld['hinh_anh']; // lấy ảnh cũ để phục vụ cho sửa ảnh

            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_nhap = $_POST['gia_nhap'] ?? '';
            $gia_ban = $_POST['gia_ban'] ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
            // $so_luong = $_POST['so_luong'] ?? '';
            $ngay_nhap = $_POST['ngay_nhap'] ?? '';
            $danh_muc_id = $_POST['danh_muc_id'] ?? '';
            // $trang_thai = $_POST['trang_thai'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';


            $hinh_anh = $_FILES['hinh_anh'] ?? '';



            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];

            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
            }
            if (empty($gia_ban)) {
                $errors['gia_ban'] = 'Gia ban không được để trống';
            }
            if (empty($gia_khuyen_mai)) {
                $errors['gia_khuyen_mai'] = 'Gia ban không được để trống';
            }
            if (empty($mo_ta)) {
                $errors['mo_ta'] = 'Mo ta không được để trống';
            }

            // if (empty($so_luong)) {
            //     $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
            // }
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để trống';
            }
            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Danh mục sản phẩm phải chọn';
            }
            // if (empty($trang_thai)) {
            //     $errors['trang_thai'] = 'Trạng thái sản phẩm phải chọn';
            // }


            // var_dump($gia_khuyen_mai);
            // die();

            $_SESSION['errors'] = $errors;


            // logic sửa ảnh 
            if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
                // upload ảnh mới lên
                $new_file = uploadFile($hinh_anh, './admin/uploads/');

                if (!empty($old_file)) {   // Nếu có ảnh cũ thì xóa đi
                    deleteFile($old_file);
                }
            } else {
                $new_file = $old_file;
            }


            // nếu ko có lỗi thì tiến hành thêm sản phẩm
            if (empty($errors)) {
                // var_dump('abc'); die;

                $this->modelSanPham->updateSanPham(
                    $san_pham_id,

                    $ten_san_pham,
                    $gia_nhap,
                    $gia_ban,
                    $gia_khuyen_mai,
                    // $so_luong,
                    $ngay_nhap,
                    $danh_muc_id,
                    // $trang_thai,
                    $mo_ta,

                    $new_file
                );


                header('location: ?act=san-phams');
                exit();
            } else {
                //Trả về form và lỗi 
                // Đặt chỉ thị xóa section sau khi hiển thị form
                $_SESSION['flash'] = true;

                header('location: ?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
                exit();
            }
        }
    }

    public function deleteSanPham()
    {
        $id = $_GET['id_san_pham'];
        $SanPham = $this->modelSanPham->getDetailSanPham($id);

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);


        if ($SanPham) {
            deleteFile($SanPham['hinh_anh']);
            $this->modelSanPham->destroySanPham($id);
        }
        if ($listAnhSanPham) {
            foreach ($listAnhSanPham as $key => $anhSP) {
                deleteFile($anhSP['link_hinh_anh']);
                $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
            }
        }

        header('location: ?act=san-phams');
        exit();
    }


    // public function postEditAnhSanPham(){
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $san_pham_id = $_POST['san_pham_id'] ?? '';


    //         // lấy danh sách ảnh hiện tại của sản phẩm
    //         $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);


    //         //xử lý các  ảnh đc gửi từ from
    //         $img_array = $_FILES['img_array'];
    //         $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
    //         $current_img_ids =  $_POST['current_img_ids'] ?? [];


    //         //khai báo mảng để lưu ảnh thếm mới để thay thế ảnh cũ
    //         $upload_file = [];


    //         // Upload ảnh mới hoặc thay thế ảnh cũ
    //         foreach($img_array['name'] as $key=>$value){
    //             if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
    //                 $new_file = uploadFileAlbum($img_array, './uploads/', $key);
    //                 if ($new_file) {
    //                     $upload_File[] = [
    //                         'id' => $current_img_ids[$key] ?? null,
    //                         'file' => $new_file
    //                     ];
    //                 }
    //             }
    //         }

    //         // // lưu ảnh mới vào db và xóa ảnh cũ
    //         // foreach($upload_File as $file_info){
    //         //     if ($file_info['id']) {
    //         //         $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];


    //         //         // cập nhật ảnh cũ 
    //         //         $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);

    //         //         // xóa ảnh cũ
    //         //         deleteFile($old_file);
    //         //     } else{
    //         //         // thêm ảnh mơis
    //         //         $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
    //         //     }
    //         // }

    //         // // xữ lý xóa ảnh 
    //         // foreach($listAnhSanPhamCurrent as $anhSP){
    //         //     $anh_id = $anhSP['id'];
    //         //     if (in_array($anh_id, $img_delete)) {
    //         //         // xóa ảnh trong db 
    //         //         $this->modelSanPham->destroyAnhSanPham($anh_id);

    //         //         // xóa file
    //         //         deleteFile($anhSP['link_hinh_anh']);
    //         //     }
    //         // }
    //         // header('location: ?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
    //         // exit();
    //     }
    // }





}
