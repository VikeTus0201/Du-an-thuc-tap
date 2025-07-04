<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/layout/header.css?v=<?= time(); ?>">>
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <h2>
                    <a href="./">
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

            <div class="icons">
                <!-- Search -->
                <div class="search-container">
                    <form action="./?act=view-products" method="GET">
                        <input type="hidden" name="act" value="view-products">
                        <input
                            type="text"
                            id="search-input"
                            name="q"
                            class="search-input"
                            placeholder="Tìm kiếm sản phẩm..."
                            required>
                        <button type="button" id="search-icon" class="icon-btn">
                            <img src="https://cdn-icons-png.flaticon.com/128/54/54481.png" alt="Search">
                        </button>
                    </form>
                </div>

                <!-- Cart -->
                <a href="./?act=my-cart" class="icon-btn">
                    <img src="https://cdn-icons-png.flaticon.com/128/2211/2211008.png" alt="Cart">
                    <?php if(isset($_SESSION['gio_hang']) && count($_SESSION['gio_hang']) > 0): ?>
                        <span class="cart-badge"><?= count($_SESSION['gio_hang']) ?></span>
                    <?php endif; ?>
                </a>

                <!-- Profile -->
                <div class="profile-container">
                    <button class="icon-btn">
                        <img src="https://cdn-icons-png.flaticon.com/128/3024/3024605.png" alt="Profile">
                    </button>
                    <div class="profile-menu">
                        <?php if (isset($_SESSION['email'])): ?>
                            <a href="#">Thông tin tài khoản</a>
                            <a href="./?act=my-order">Đơn hàng của tôi</a>
                            <a href="./?act=logout">Đăng xuất</a>
                        <?php else: ?>
                            <a href="<?= BASE_URL ?>?act=login">Đăng nhập</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <script src="<?= BASE_URL ?>assets/js/header.js?v=<?= time(); ?>"></script>
    <script>
        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchIcon = document.getElementById('search-icon');
            const searchInput = document.getElementById('search-input');
            
            if (searchIcon && searchInput) {
                searchIcon.addEventListener('click', function() {
                    searchInput.classList.toggle('active');
                    if (searchInput.classList.contains('active')) {
                        searchInput.focus();
                    }
                });
                
                // Submit form on Enter
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        this.closest('form').submit();
                    }
                });
            }
        });
    </script>
</body>

</html>