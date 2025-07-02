<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Khuyen Mai | NN Shop</title>
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
                                <h4 class="mb-sm-0">Tai khoan quan tri</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Tai khoan quan tri</li>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Danh sach khuyen mai  </h4>
                                  <a href="?act=form-them-khuyen-mai" class="btn btn-soft-success material-shadow-none">
                                    <i class="ri-add-circle-line align-middle me-1"></i> Them khuyen mai </button></a> 

                        
                                      
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-nowrap align-middle mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">STT</th>
                                                        <th scope="col">Ma Khuyen Mai</th>
                                                        <th scope="col">Ten Khuyen Mai</th>
                                                        <th scope="col">Muc giam</th>
                                                        <th scope="col">So Luong</th>
                                                        <th scope="col">Ngay Bat Dau</th>
                                                        <th scope="col">Ngay Ket Thuc</th>
                                                        <th scope="col">Mo Ta</th>
                                                        <th scope="col">Trang Thai</th>
                                                        <th scope="col">Thao Tac</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach ($khuyenMais as $index => $khuyenmai) :
                                                    ?>
                                                    <tr>
                                                        <td class="fw-medium"><?= $index + 1?></td>
                                                        <td><?= $khuyenmai['ma_khuyen_mai'] ?></td>
                                                        <td><?= $khuyenmai['ten_khuyen_mai'] ?></td>
                                                        <td><?= $khuyenmai['muc_giam'] ?></td>
                                                        <td><?= $khuyenmai['so_luong'] ?></td>
                                                        <td><?= $khuyenmai['ngay_bat_dau'] ?></td>
                                                        <td><?= $khuyenmai['ngay_ket_thuc'] ?></td>
                                                        <td><?= $khuyenmai['mo_ta'] ?></td>
                                                        <td>
                                                            <?php 
                                                            if($khuyenmai['trang_thai']==1){?>
                                                                <span class="badge bg-success">Con Ma </span>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                     <span class="badge bg-danger">Het ma </span>
                                                                <?php

                                                            }
                                                            
                                                            ?>
                                                            
                                                        </td>
                                                        
                                                        <td>
                                                          <div class="hstack gap-3 flex-wrap">
                                                                        <a href="?act=form-sua-khuyen-mai&khuyen_mai_id=<?= $khuyenmai['id'] ?>" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                                                        <form action="?act=xoa-khuyen-mai" method="POST" onsubmit="return confirm('ban co dong y xoa khong')">
                                                                            <input type="hidden" name="khuyen_mai_id" value="<?= $khuyenmai['id'] ?>">

                                                                        <button type="submit" class="link-danger fs-15" style="border: none; background: none;"><i class="ri-delete-bin-line"></i></button>
                                                                        </form>
                                                                        <!-- <a href="javascript:void(0);" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a> -->
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

                                                                