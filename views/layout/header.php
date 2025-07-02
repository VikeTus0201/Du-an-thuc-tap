<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="http://localhost/Thuctap/Project_thuc_tap/assets/css/layout/header.css?v=<?= time(); ?>">
</head>

<body>
    <header class="header">
        <div class="logo">
            <h2 style="font-weight: 600;">
                <a href="./" style="text-decoration: none; color: black;">
                    <span class="highlight">P</span>rime
                </a>
            </h2>
        </div>
        <nav class="nav">
            <a href="./">Home</a>
            <a href="./?act=view-products">Products</a>
            <a href="./?act=about-us">About Us</a>
            <a href="./?act=contact">Contact</a>
        </nav>
        <!-- Input Search -->

        <div class="icons" style="margin-right: 15px;">
            <!-- Biểu tượng tìm kiếm -->
            <!-- Biểu tượng tìm kiếm -->
            <form action="./?act=view-products" method="GET" style="display: flex; align-items: center;">
                <input type="hidden" name="act" value="view-products">
                <input
                    type="text"
                    id="search-input"
                    name="q"
                    class="search-input"
                    placeholder="Search..."
                    style="display: none;"
                    required>
                <button type="button" id="search-icon" style="border: none; background: none;">
                    <img src="https://cdn-icons-png.flaticon.com/128/54/54481.png" alt="Search Icon">
                </button>
            </form>

            <!-- Biểu tượng giỏ hàng -->
            <a href="./?act=my-cart" style="margin-right: 15px;"><img src="https://cdn-icons-png.flaticon.com/128/2211/2211008.png" alt="Cart Icon"></a>
            <!-- <span style="position: absolute; 
                         right: 415px;
                         font-size: 13px;
                         top: 43px;
                         font-weight: bold;
                         "><?php
                         if(isset($_SESSION['gio_hang'])){
                            echo '('.  count($_SESSION['gio_hang']) . ')';
                         }else{
                            echo '(0)';
                         }
                         ?></span> -->
            <!-- Biểu tượng profile -->
            <div class="profile-container">
                <img src="https://cdn-icons-png.flaticon.com/128/3024/3024605.png" alt="Profile Icon" class="profile">
                <!-- Menu dropdown -->
                <div class="profile-menu" id="profile-menu">
                    <!-- Nội dung sẽ được thêm hoặc thay đổi bằng JavaScript -->
                    <?php if (isset($_SESSION['email'])) { ?>

                        <a href="#">Account Info</a><br>
                        <a href="./?act=my-order">My Orders</a><br>
                        <a href="./?act=logout">Logout</a>

                    <?php } else { ?>
                        <a href=" http://localhost/Thuctap/Project_thuc_tap/?act=login">Login</a>

                    <?php } ?>
                </div>
            </div>

        </div>


    </header>

    <script src="http://localhost/Thuctap/Project_thuc_tap/assets/js/header.js?v=<?= time(); ?>">


    </script>
</body>

</html>