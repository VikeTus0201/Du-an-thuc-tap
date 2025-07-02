<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Quản lý tài khoản | PRIME shoes Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- CSS -->
    <?php
    require_once "views/layouts/libs_css.php";
    ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- HEADER -->
        <?php
        require_once "views/layouts/header.php";

        require_once "views/layouts/siderbar.php";
        ?>

        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Quản lý tài khoản</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Tài khoản</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <div class="h-100">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Danh sách tài khoản </h4>
                                        <a href="?act=form-them-quan-tri" class="btn btn-soft-success material-shadow-none">
                                            <i class="ri-add-circle-line align-middle me-1"></i> Thêm quản trị </button></a>



                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">STT</th>
                                                            <th scope="col">Họ tên</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">SDT</th>


                                                            <!-- <th scope="col">Mật khẩu</th> -->
                                                            <th scope="col">Chức vụ</th>
                                                            <th scope="col">Địa chỉ</th>

                                                            <th scope="col">Avatar</th>
                                                            <th scope="col">Sinh nhật</th>
                                                            <th scope="col">Trạng thái</th>

                                                            <th scope="col">Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($listQuanTri as $index => $quanTri) :
                                                        ?>
                                                            <tr>
                                                                <td class="fw-medium"><?= $index + 1 ?></td>
                                                                <td><?= $quanTri['ho_ten'] ?></td>
                                                                <td><?= $quanTri['email'] ?></td>
                                                                <td><?= $quanTri['so_dien_thoai'] ?></td>

                                                                <!-- <td><?= $quanTri['mat_khau'] ?></td> -->

                                                                <td><?= $quanTri['chuc_vu_id'] == 1 ? 'Admin' : 'Khách hàng'; ?></td>
                                                                <td><?= $quanTri['dia_chi'] ?></td>
                                                                <td>
                                                                    <img src="<?= BASE_URL . $quanTri['avata'] ?>" style="width: 50px" alt="">

                                                                </td>
                                                                <td><?= $quanTri['ngay_sinh'] ?></td>

                                                                <td>
                                                                    <?php
                                                                    if ($quanTri['trang_thai'] == 1) {
                                                                    ?>
                                                                        <span class="badge bg-success">Hoạt động</span>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <span class="badge bg-danger">Không hoạt động</span>

                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </td>
                                                                <td>
                                                                    <div class="hstack gap-3 flex-wrap">
                                                                        <!-- Hiển thị nút sửa -->
                                                                        <a href="?act=form-sua-quan-tri&quan_tri_id=<?= $quanTri['id'] ?>" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>

                                                                        <!-- Kiểm tra nếu tài khoản hiện tại không phải là tài khoản đang đăng nhập thì hiển thị nút xóa -->
                                                                        <?php if ($_SESSION['user_admin'] != $quanTri['email']) : ?>
                                                                            <form action="?act=xoa-tai-khoan-quan-tri" method="POST" onsubmit="return confirm('Bạn có đồng ý xóa không?')">
                                                                                <input type="hidden" name="quan_tri_id" value="<?= $quanTri['id'] ?>">
                                                                                <button type="submit" class="link-danger fs-15" style="border: none; background: none;"><i class="ri-delete-bin-line"></i></button>
                                                                            </form>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </td>

                                                            </tr>

                                                        <?php endforeach;  ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div> <!-- end col -->
                        </div>

                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © Velzon.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by Themesbrand
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->



        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

        <!--preloader-->
        <div id="preloader">
            <div id="status">
                <div class="spinner-border text-primary avatar-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <div class="customizer-setting d-none d-md-block">
            <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
                <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <?php
        require_once "views/layouts/libs_js.php";
        ?>

</body>

</html>