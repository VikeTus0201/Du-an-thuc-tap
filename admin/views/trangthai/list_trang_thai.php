<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Danh sách đơn hàng | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- CSS -->
    <?php require_once "views/layouts/libs_css.php"; ?>
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- HEADER -->
        <?php
        require_once "views/layouts/header.php";
        require_once "views/layouts/siderbar.php";
        ?>

        <div class="vertical-overlay"></div>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Quản lý đơn hàng</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Danh sách đơn hàng</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Display list of orders -->
                    <div class="row">
                        <div class="col">
                            <div class="h-100">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Danh sách đơn hàng</h4>
                                        <!-- <a href="?act=form-them-don-hang" class="btn btn-soft-success material-shadow-none"><i class="ri-add-circle-line align-middle me-1"></i> Thêm đơn hàng mới</a> -->
                                    </div>

                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr>
                                                            <!-- <th scope="col">STT</th> -->
                                                            <th scope="col">Mã đơn hàng</th>
                                                            <th scope="col">Khách hàng</th>
                                                            <th scope="col">Tổng tiền</th>
                                                            <th scope="col">Trạng thái</th>
                                                            <th scope="col">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- <?php var_dump($donHangs); ?> -->
                                                        <?php foreach ($donHangs as $index => $donHang): ?>
                                                            <tr>
                                                                <!-- <td class="fw-medium"><?= $index + 1 ?></td> -->
                                                                <td>P<?= $donHang['id'] ?></td>
                                                                <td><?= $donHang['ho_ten'] ?></td>
                                                                <td><?= number_format($donHang['tong_tien'], 0, ',', '.') ?> VNĐ</td>
                                                                <td>
                                                                    <form action="?act=updateOrderStatus" method="POST">
                                                                        <input type="hidden" name="order_id" value="<?= $donHang['id'] ?>" />
                                                                        <select name="status_id" onchange="this.form.submit()" class="form-select form-select-sm">
                                                                            <option value="1" <?= ($donHang['trang_thai_id'] == 1) ? 'selected' : '' ?> <?= ($donHang['trang_thai_id'] > 1) ? 'disabled' : '' ?>>Chờ xác nhận</option>
                                                                            <option value="2" <?= ($donHang['trang_thai_id'] == 2) ? 'selected' : '' ?> <?= ($donHang['trang_thai_id'] > 2) ? 'disabled' : '' ?>>Đã xác nhận</option>
                                                                            <option value="3" <?= ($donHang['trang_thai_id'] == 3) ? 'selected' : '' ?> <?= ($donHang['trang_thai_id'] > 3) ? 'disabled' : '' ?>>Đang chuẩn bị hàng</option>
                                                                            <option value="4" <?= ($donHang['trang_thai_id'] == 4) ? 'selected' : '' ?> <?= ($donHang['trang_thai_id'] > 4) ? 'disabled' : '' ?>>Đang giao hàng</option>
                                                                            <option value="5" <?= ($donHang['trang_thai_id'] == 5) ? 'selected' : '' ?> <?= ($donHang['trang_thai_id'] > 5) ? 'disabled' : '' ?>>Đã giao hàng</option>
                                                                            <option value="6" <?= ($donHang['trang_thai_id'] == 6) ? 'selected' : '' ?> disabled>Đã hủy</option>
                                                                        </select>
                                                                    </form>
                                                                </td>


                                                                <td>
                                                                    <div class="hstack gap-3 flex-wrap">
                                                                        <a href="">Chi tiết</a>
                                                                        <!-- <a href="?act=form-sua-don-hang&id=<?= $donHang['id'] ?>" class="link-success fs-15"><i class="ri-edit-2-line"></i></a> -->
                                                                        <!-- <form action="?act=xoa-don-hang" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                                                            <input type="hidden" name="id" value="<?= $donHang['id'] ?>">
                                                                            <button type="submit" class="link-danger fs-15" style="border: none; background: none;">
                                                                                <i class="ri-delete-bin-line"></i>
                                                                            </button>
                                                                        </form> -->
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div><!-- end .h-100-->
                        </div><!-- end col -->
                    </div>
                </div><!-- container-fluid -->
            </div><!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © NN Shop.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">Design & Develop by NN Shop</div>
                        </div>
                    </div>
                </div>
            </footer>
        </div><!-- end main content-->
    </div><!-- END layout-wrapper -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button><!--end back-to-top-->

    <!-- JAVASCRIPT -->
    <?php require_once "views/layouts/libs_js.php"; ?>
</body>

</html>