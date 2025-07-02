<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title> | NN Shop</title>
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
                                <h4 class="mb-sm-0">Sua Khuyen Mai   </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">ADMIN</a></li>
                                        <li class="breadcrumb-item active"> </li>
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
                                    <h4 class="card-title mb-0 flex-grow-1"> </h4>
                                  
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="?act=sua-khuyen-mai" method="POST">
                                            <input type="hidden" name="id" value="<?= $khuyenmai['id'] ?>">
                                            <div class="row">
                                                <div class="col-md-12"> 
                                                    <div class="mb-3">
                                                        <label for="compnayNameinput" class="form-label"> Ma Khuyen Mai</label>
                                                        <input type="text" class="form-control" placeholder="Nhap Ma Khuyen Mai" name="ma_khuyen_mai" value="<?= $khuyenmai['ma_khuyen_mai'] ?>">
                                                        <span class="text-danger">
                                                            <?= !empty($_SESSION['errors']['ma_khuyen_mai']) ? $_SESSION['errors']['ma_khuyen_mai'] : '' ?>

                                                        </span>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                              
                                                <!--end col-->
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="emailidInput" class="form-label">Ten Khuyen Mai</label>
                                                        <input type="text" class="form-control" placeholder="Nhap Ten Khuyen Mai" name="ten_khuyen_mai" value="<?= $khuyenmai['ten_khuyen_mai'] ?>">
                                                        <span class="text-danger">
                                                            <?= !empty($_SESSION['errors']['ten_khuyen_mai']) ? $_SESSION['errors']['ten_khuyen_mai'] : '' ?>

                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="emailidInput" class="form-label">Muc Giam</label>
                                                        <input type="text" class="form-control" placeholder="Nhap Muc Giam" name="muc_giam" value="<?= $khuyenmai['muc_giam'] ?>">
                                                        <span class="text-danger">
                                                            <?= !empty($_SESSION['errors']['muc_giam']) ? $_SESSION['errors']['muc_giam'] : '' ?>

                                                        </span>
                                                    </div>
                                                </div>
                                               
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="emailidInput" class="form-label">So Luong</label>
                                                        <input type="number" class="form-control" placeholder="Nhap So Luong" name="so_luong" value="<?= $khuyenmai['so_luong'] ?>">
                                                        <span class="text-danger">
                                                            <?= !empty($_SESSION['errors']['so_luong']) ? $_SESSION['errors']['so_luong'] : '' ?>

                                                        </span>
                                                    </div>
                                                </div>
                                               

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="emailidInput" class="form-label">Ngay Bat Dau </label>
                                                        <input type="date" class="form-control" placeholder="" name="ngay_bat_dau" value="<?= $khuyenmai['ngay_bat_dau'] ?>">
                                                        <span class="text-danger">
                                                            <?= !empty($_SESSION['errors']['ngay_bat_dau']) ? $_SESSION['errors']['ngay_bat_dau'] : '' ?>

                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="emailidInput" class="form-label">Ngay ket thuc </label>
                                                        <input type="date" class="form-control" placeholder="" name="ngay_ket_thuc" value="<?= $khuyenmai['ngay_ket_thuc'] ?>">
                                                        <span class="text-danger">
                                                            <?= !empty($_SESSION['errors']['ngay_ket_thuc']) ? $_SESSION['errors']['ngay_ket_thuc'] : '' ?>

                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="emailidInput" class="form-label">Mo Ta </label>
                                                        <input type="text" class="form-control" placeholder="" name="mo_ta" value="<?= $khuyenmai['mo_ta'] ?>">
                                                        <span class="text-danger">
                                                            <?= !empty($_SESSION['errors']['mo_ta']) ? $_SESSION['errors']['mo_ta'] : '' ?>

                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="emailidInput" class="form-label">Trang thai </label>
                                                        <select class="form-select" name="trang_thai">
                                                        <option selected disabled>Chọn trạng thái</option>
                                                            <option value="1"<?= $khuyenmai['trang_thai']==1 ? 'selected' : '' ?>>Con ma </option>
                                                            <option value="2"<?= $khuyenmai['trang_thai']==2 ? 'selected' : '' ?>>Het ma </option>>
                                                        </select>
                                                        <span class="text-danger">
                                                            <?= !empty($_SESSION['errors']['trang_thai']) ? $_SESSION['errors']['trang_thai'] : '' ?>

                                                        </span>
                                                    </div>
                                                </div>
                                               
                                               
                                                <!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                
                                </div>
                            </div>
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