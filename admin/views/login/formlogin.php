<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Đăng Nhập Admin </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <!-- <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div> -->

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <!-- <h2 style="font-weight: 600; font: size 400px;"><a href="./" style="text-decoration: none; color:black"><span class="highlight">P</span>rime</a></h2> -->
                                    <!-- <img src="https://img3.thuthuatphanmem.vn/uploads/2019/09/30/logo-shop-quan-ao-nam_111916701.jpg" alt="" height="80px" style = "border-radius: 20px"> -->
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Đăng Nhập Quản Trị </p>
                                </div>
                                <div class="p-2 mt-4">
                                    <?php if (isset($_SESSION['errors'])) { ?>
                                        <p class="text-danger text-center" style="font-weight: bold;">
                                            <?php
                                            if (is_array($_SESSION['errors'])) {

                                                foreach ($_SESSION['errors'] as $error) {
                                                    echo $error . "<br>";
                                                }
                                            } else {

                                                echo $_SESSION['errors'];
                                            }
                                            ?>
                                        </p>
                                    <?php } else { ?>
                                        <p class="login-box-msg text-center" style="color: red; font-size: 17px;">
                                            Vui Lòng Đăng Nhập
                                        </p>
                                    <?php } ?>
                                    <form action=" <?= BASE_URL_ADMIN . '?act=check-login-admin' ?>" method="POST">

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="username" placeholder="Enter username" name="email">
                                            <span class="text-danger">
                                                <?= !empty($_SESSION['errors']['email']) ? $_SESSION['errors']['email'] : '' ?>

                                            </span>
                                        </div>

                                        <div class="mb-3">

                                            <label class="form-label" for="password-input">Password</label>

                                            <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" id="password-input" name="password">
                                            <span class="text-danger">
                                                <?= !empty($_SESSION['errors']['password']) ? $_SESSION['errors']['password'] : '' ?>

                                            </span>

                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Đăng Nhập</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->



                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->

        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="assets/js/pages/password-addon.init.js"></script>
</body>

</html>