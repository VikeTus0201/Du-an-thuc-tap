<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Shoes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/home/home.css?v=<?= time(); ?>">
</head>

<body>
    <?php require_once './views/layout/header.php'; ?>
    <div class="container">
        <!-- <img src="./admin/uploads/1733803411wp13319801-angled-waves-wallpapers.jpg" alt=""> -->


        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-text">
                <h1>Perfect Your Walk</h1>
                <p>With 2022 wrapped up, it’s time we come <br> up with ideas to rock 2023! And how else <br> to kick-start the new year other than <br> looking at being a trend-setter?</p>
                <a href="./?act=view-products" class="btn">Explore Now</a>
            </div>
            <div class="banner">
                <div class="slideshow">
                    <img src="<?= BASE_URL ?>assets/img/pngegg.png" alt="Slide 1">
                    <img src="<?= BASE_URL ?>assets/img/pngegg2.png" alt="Slide 2">
                    <img src="<?= BASE_URL ?>assets/img/pngegg4.png" alt="Slide 3">
                    <!-- <img src="<?= BASE_URL ?>assets/img/pngegg3.png" alt="Slide 3"> -->
                    <!-- <img src="<?= BASE_URL ?>assets/img/pngegg5.png" alt="Slide 3"> -->
                    <img src="<?= BASE_URL ?>assets/img/pngegg1.png" alt="Slide 3">
                    <!-- <img src="<?= BASE_URL ?>assets/img/pngegg.png" alt="Slide 1 Clone"> Slide lặp -->
                </div>
            </div>


        </section>

        <!-- Brands Section -->
        <section class="brands">
            <h2>Our Brands</h2>
            <div class="brand-logos">
                <ul>
                    <?php foreach ($categories as $category): ?>
                        <li>
                            <a href="?id=<?php echo $category['id']; ?>">
                                <?php echo htmlspecialchars($category['ten_danh_muc']); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="product-list">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-item">
                            <!-- Thêm liên kết bao quanh hình ảnh -->
                            <a href="./?act=product-detail&id=<?= $product['id']; ?>">
                                <img src="<?php echo ($product['hinh_anh']); ?>" alt="Product Image">
                            </a>
                            <p><?php echo ($product['ten_san_pham']); ?></p>
                            <span><?php echo (number_format($product['gia_ban'], 0, ',', '.')); ?> VND</span>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products found. Please select a brand.</p>
                <?php endif; ?>
            </div>

        </section>

        <!-- Featured Section -->
        <section class="featured">
            <div class="featured-image">
                <img src="https://cdn.authentic-shoes.com/wp-content/uploads/2023/07/05105726-567002_cover_1920x1080-1.webp" alt="Featured Shoe - Tuff Copa Pure">
            </div>
            <div class="featured-text">
                <h3>Tuff Copa Pure</h3>
                <p>Classic and modern styles combined for ultimate performance.</p>
                <a href="./?act=view-products" class="btn">See More</a>
            </div>
        </section>

        <!-- What's Hot Section -->
        <section class="whats-hot">
            <h2>What's Hot</h2>
            <div class="hot-items">
                <div class="hot-item">
                    <img src="https://brand.assets.adidas.com/image/upload/f_auto,q_auto,fl_lossy/if_w_gt_400,w_400/5040128_Teaser_Carousel_1050x1400_80c11024a0.jpg" alt="FORUM Exhibit">
                    <p>FORUM Exhibit</p>
                </div>
                <div class="hot-item">
                    <img src="https://brand.assets.adidas.com/image/upload/f_auto,q_auto,fl_lossy/if_w_gt_400,w_400/originals_fw24_embargo_bape9_ct_d_d_a5390f32d6.jpg" alt="Y-3 Kaiwa">
                    <p>Y-3 Kaiwa</p>
                </div>
                <div class="hot-item">
                    <img src="https://brand.assets.adidas.com/image/upload/f_auto,q_auto,fl_lossy/if_w_gt_400,w_400/fw24_ec_clot_november_collection_launch_confirmed_hp_tc_d_d2986cba54.jpg" alt="Gazelle Bold">
                    <p>Gazelle Bold</p>
                </div>
                <div class="hot-item">
                    <img src="https://brand.assets.adidas.com/image/upload/f_auto,q_auto,fl_lossy/if_w_gt_400,w_400/4993730_CAM_Onsite_FW_24_Walking_Shoe_24_Oct_TH_HP_GLP_Teaser_Carousel_Dual_Gender_1050x1400_ad15063741.jpg" alt="Samba OG">
                    <p>Samba OG</p>
                </div>
            </div>
        </section>

        <!-- Footer -->



    </div>
    <?php require_once './views/layout/footer.php'; ?>
    <script src="<?= BASE_URL ?>assets/js/home.js"></script>
</body>

</html>