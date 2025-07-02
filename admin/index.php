<?php
session_start();

// $act = $_GET['act'] ?? '/';


// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/DanhMucController.php';
require_once 'controllers/TrangThaiController.php';
require_once 'controllers/TinTucController.php';
require_once 'controllers/TaiKhoanController.php';
require_once 'controllers/LienHeController.php';
require_once 'controllers/SanPhamController.php';
require_once 'controllers/DangNhapController.php';
require_once 'controllers/ThongkeControler.php';


// Require toàn bộ file Models
require_once 'models/DanhMuc.php';
require_once 'models/TaiKhoan.php';
require_once 'models/TrangThai.php';
require_once 'models/TinTuc.php';
require_once 'models/LienHe.php';
require_once 'models/SanPham.php';
require_once 'models/DangNhap.php';
require_once 'models/ThongKe.php';


// Route
$act = $_GET['act'] ?? '/';

if ($act !== 'login-admin' && $act !== 'check-login-admin' && $act !== 'log-out') {
    // checkLoginAdmin();

    if (!isset($_SESSION['user_admin'])) {
        header('location:?act=login-admin');
        exit();
    }
}


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Dashboards
    '/'                      => (new DashboardController())->index(),
    'thongke' => (new ThongKeController())->trangThaiDonHang(),
    

    //quản lý danh mục sản phẩm
    'danh-mucs'              => (new DanhMucController())->index(),
    'form- them-danh-muc'    => (new DanhMucController())->create(),
    'them-danh-muc'          => (new DanhMucController())->store(),
    'form-sua-danh-muc'      => (new DanhMucController())->edit(),
    'sua-danh-muc'           => (new DanhMucController())->update(),
    'xoa-danh-muc'           => (new DanhMucController())->destroy(),

    // quan ly san pham 
    'san-phams'              => (new SanPhamController())->listSanPham(),
    'form-them-san-pham'    => (new SanPhamController())->formaddSanPham(),
    'them-san-pham'          => (new SanPhamController())->postAddSanPham(),
    'form-sua-san-pham'      => (new SanPhamController())->formEditSanPham(),
    // 'sua-album-anh-san-pham' =>(new SanPhamController())->postEditAnhSanPham(),
    'sua-san-pham'           => (new SanPhamController())->postEditSanPham(),
    'xoa-san-pham'           => (new SanPhamController())->deleteSanPham(),

    // quản lý người dùng
    'tai-khoans'         => (new TaiKhoanController())->index_taikhoan(),
    'form-them-quan-tri' => (new TaiKhoanController())->formAddQuanTri(),
    'them-quan-tri' => (new TaiKhoanController())->postAddQuanTri(),
    'xoa-tai-khoan-quan-tri' => (new TaiKhoanController())->deleteQuanTri(),
    'form-sua-quan-tri' => (new TaiKhoanController())->formEditQuanTri(),
    'sua-quan-tri' => (new TaiKhoanController())->postEditQuanTri(),

    // 'tai-khoan-khach-hang'=>(new TaiKhoanController())->danhsachkhachhang(),
    // 'form-them-khach-hang' => (new TaiKhoanController())->formAddkhachhang(),
    // 'xoa-tai-khoan-khach-hang' =>(new TaiKhoanController())->deleteKhachHang(),
    // 'form-sua-khach-hang' =>(new TaiKhoanController())->formEditKhachHang(),
    'sua-khach-hang' => (new TaiKhoanController())->postEditKhachHang(),

    'khuyen-mais' => (new TaiKhoanController())->danhsachma(),
    'form-them-khuyen-mai' => (new TaiKhoanController())->formAddkhuyenmai(),
    'them-khuyen-mai' => (new TaiKhoanController())->Addkhuyenmai(),
    'xoa-khuyen-mai' => (new TaiKhoanController())->deletekhuyenmai(),
    'form-sua-khuyen-mai' => (new TaiKhoanController())->formEditKhuyenmai(),
    'sua-khuyen-mai' => (new TaiKhoanController())->postEditKhuyenmai(),


    // Trang thái đơn hàng
    'trang-thais'              => (new TrangThaiController())->index_trang_thai(),
    // 'form- them-trang-thai'    => (new TrangThaiController())->create_trang_thai(),
    // 'them-trang-thai'          => (new TrangThaiController())->store_trang_thai(),
    // 'form-sua-trang-thai'      => (new TrangThaiController())->edit_trang_thai(),
    // 'sua-trang-thai'           => (new TrangThaiController())->update_trang_thai(),
    // 'xoa-trang-thai'           => (new TrangThaiController())->destroy_trang_thai(),
    'updateOrderStatus'           => (new TrangThaiController())->updateOrderStatus(),
    // quản lý tin tức sản phẩm
    'tin-tucs'          => (new TinTucController())->index_tin_tuc(),
    'form-them-tin-tuc' => (new TinTucController())->create_tin_tuc(),
    'them-tin-tuc'      => (new TinTucController())->store_tin_tuc(),
    'form-sua-tin-tuc'  => (new TinTucController())->edit_tin_tuc(),
    'sua-tin-tuc'       => (new TinTucController())->update_tin_tuc(),
    'xoa-tin-tuc'       => (new TinTucController())->destroy_tin_tuc(),
    //quản lý liên hệ
    'lien-hes'              => (new LienHeController())->index_lien_he(),
    'form- them-lien-he'    => (new LienHeController())->create_lien_he(),
    'them-lien-he'          => (new LienHeController())->store_lien_he(),
    'form-sua-lien-he'      => (new LienHeController())->edit_lien_he(),
    'sua-lien-he'           => (new LienHeController())->update_lien_he(),
    'xoa-lien-he'           => (new LienHeController())->destroy_lien_he(),

     //rout auth
     'login-admin' => (new DangNhapController())->formlogin(),
     'check-login-admin' => (new DangNhapController())->login(),
     'log-out' => (new DangNhapController())->logout(),



};
