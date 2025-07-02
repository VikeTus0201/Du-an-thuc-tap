<?php
class ThongKeController
{


    public $modelThongKe;

    public function __construct()
    {
        $this->modelThongKe = new ThongKe();
    }


    public function trangThaiDonHang()
    {
        $count = $this->modelThongKe->countTrangThaiDonHang();

        $choXacNhan = $this->modelThongKe->countChoXacNhan();
        $daXacNhan = $this->modelThongKe->countDaXacNhan();
        $chuanBi = $this->modelThongKe->countChuanBi();
        $dangGiao = $this->modelThongKe->countDangGiao();
        $daGiao = $this->modelThongKe->countDaGiao();
        // $thatBai = $this->modelThongKe->countThatBai();
        $huy = $this->modelThongKe->countDaHuy();


        $dem = $this->modelThongKe->countDonHang();
        $demkh = $this->modelThongKe->countKhachHang();
        $sum = $this->modelThongKe->sumDonHang();
        // var_dump($huy);die();
        // $dem = $count;
        $listNamDonHang = $this->modelThongKe->namDonHang();
        // var_dump($listNamDonHang);die;
        //moi
        $topNamSanPham = $this->modelThongKe->top5SanPhamBanChay();
        // var_dump($topNamSanPham);die;

        require_once './views/db.php';
    }
}
