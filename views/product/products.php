<html>

<head>
    <title>Product</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="http://localhost/Thuctap/Project_thuc_tap/assets/css/product/product.css?v=<?= time(); ?>">
</head>

<body>
    <?php require_once './views/layout/header.php'; ?>
    <div class="container">
        <aside class="sidebar">
            <div class="brand-logos">
                <ul>
                    <li>
                        <button class="<?= !isset($_GET['id']) ? 'active' : ''; ?>">
                            <a href="?act=view-products">All</a>
                        </button>
                    </li>

                    <?php foreach ($categories as $category): ?>
                        <li>
                            <!-- Sửa href để đảm bảo tham số id được truyền đúng -->
                            <button class="<?= isset($_GET['id']) && $_GET['id'] == $category['id'] ? 'active' : ''; ?>">

                                <a href="?act=view-products&id=<?= $category['id']; ?>">
                                    <?= ($category['ten_danh_muc']); ?>
                                </a>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </aside>


        <main class="main-content">
            <div class="filters">
                <button>FILTER</button>
                <?php if (isset($_GET['q']) && trim($_GET['q']) !== '') { ?>
                    <h2>Search results for: "<?= ($_GET['q']); ?>"</h2>
                <?php } ?>


                <select>
                    <option>PRICE</option>
                </select>
            </div>


            <div class="product-grid">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <!-- Liên kết tới chi tiết sản phẩm -->
                            <a href="./?act=product-detail&id=<?= $product['id']; ?>">
                                <img src="<?= ($product['hinh_anh']); ?>" alt="Product Image">
                            </a>
                            <div class="name">
                                <?= ($product['ten_san_pham']); ?>
                            </div>
                            <div class="price">
                                <?= number_format($product['gia_ban'], 0, ',', '.'); ?> VND
                            </div>
                            <div class="rating">
                                <!-- Hiển thị sao đánh giá -->
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products found for your search.</p>
                <?php endif; ?>
            </div>
        </main>

    </div>

    <?php require_once './views/layout/footer.php'; ?>
    <script src="http://localhost/Thuctap/Project_thuc_tap/assets/js/home.js"></script>
</body>

</html>