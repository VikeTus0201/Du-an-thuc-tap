<!DOCTYPE html>
<html>

<head>
    <title><?= htmlspecialchars($product['ten_san_pham']); ?> - Product Details</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/product/product_details.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/product/ai_summary.css?v=<?= time(); ?>">
</head>

<body>

    <?php
    // var_dump($productDetails);
    require_once './views/layout/header.php'; ?>

    <div class="container">
        <!-- Hình ảnh và thông tin cơ bản -->
        <div class="product-image">
            <img alt="<?= ($product['ten_san_pham']); ?>" height="400"
                src="<?= ($product['hinh_anh']); ?>" width="400" />
            <h3>Product description</h3>
            <p><?= ($product['mo_ta']); ?></p>
        </div>
        <div class="product-details">
            <h1>
                <?= ($product['ten_san_pham']); ?>
            </h1>
            <div class="price">
                <?= number_format($product['gia_ban'], 0, ',', '.'); ?> VND
            </div>

            <!-- AI Summary Section -->
            <div class="ai-summary-container">
                <div class="ai-summary-header">
                    <svg class="ai-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    <h3>Tóm tắt AI</h3>
                </div>
                
                <div id="ai-summary-content" class="ai-summary-content" style="display: none;"></div>
                
                <div class="ai-summary-placeholder">
                    AI sẽ tạo tóm tắt thông minh về sản phẩm này dựa trên thông tin chi tiết
                </div>
                
                <div class="ai-summary-actions">
                    <button id="ai-generate-btn" class="ai-generate-btn">
                        🤖 Tạo tóm tắt
                    </button>
                    <button id="copy-summary-btn" class="copy-btn" style="display: none;">
                        📋 Sao chép
                    </button>
                </div>
                
                <div id="ai-loading" class="ai-loading">
                    <div class="spinner"></div>
                    <span>Đang xử lý...</span>
                </div>
                
                <div id="ai-error" class="ai-error"></div>
            </div>


            <!-- Màu sắc -->
            <div class="colors">
                <h3>Colors:</h3>
                <?php foreach ($productDetails as $detail): ?>
                    <span class="color-swatch"
                        style="background-color: <?= ($detail['ma_mau_hex']); ?>; 
                                 display: inline-block; 
                                 width: 30px; height: 30px; 
                                 border-radius: 50%; margin-right: 5px;"
                        onclick="updateStock('<?= ($detail['ma_mau_hex']); ?>', 'color')"></span>
                <?php endforeach; ?>
            </div>

            <!-- Kích thước -->
            <div class="sizes">
                <h3>Sizes:</h3>
                <?php foreach ($productDetails as $detail): ?>
                    <button class="size-button"
                        onclick="updateStock('<?= ($detail['so_size']); ?>', 'size')">
                        <?= ($detail['so_size']); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Số lượng tồn kho -->
            <div class="stock">
                <h3>Stock:</h3>
                <ul id="stock-list">
                    <!-- Số lượng sẽ được cập nhật bằng JavaScript -->
                </ul>
            </div>
            <!-- Số lượng mua-->
            <div class="quantity">
                <!-- <h3>Quantity:</h3>
                <input type="number" id="quantityInput" name="so_luong" value="1" min="1" max="10"
                    onchange="updateQuantity(this.value)" /> -->
            </div>


            <form action="./?act=add-to-cart" method="POST" id="addToCartForm" onsubmit="return validateStock()">
                <input type="hidden" name="id" value="<?= $product['id']; ?>">
                <input type="hidden" name="ten_san_pham" value="<?= htmlspecialchars($product['ten_san_pham']); ?>">
                <input type="hidden" name="gia_ban" value="<?= $product['gia_ban']; ?>">
                <input type="hidden" name="hinh_anh" value="<?= $product['hinh_anh']; ?>">
                <input type="hidden" name="so_luong" id="quantityInputHidden" value="1">
                <input type="hidden" name="selectedColor" id="selectedColor" value="">
                <input type="hidden" name="selectedSize" id="selectedSize" value="">
                <input type="hidden" name="stock" id="stockInput" value="">

                <div class="buttons">
                    <button type="submit" class="add-to-cart" id="addToCartBtn">Add to cart</button>
                </div>
            </form>



        </div>
    </div>

    <?php require_once './views/layout/footer.php'; ?>

    <script>
        // Dữ liệu về màu sắc, kích thước và tồn kho
        const productDetails = <?= json_encode($productDetails); ?>;

        // Lưu trữ lựa chọn hiện tại của người dùng
        let selectedColor = null;
        let selectedSize = null;

        // Cập nhật thông tin stock khi chọn màu sắc hoặc kích thước
        function updateStock(value, type) {
            if (type === 'color') {
                selectedColor = value;
                document.getElementById('selectedColor').value = selectedColor; // Cập nhật giá trị ẩn
            } else if (type === 'size') {
                selectedSize = value;
                document.getElementById('selectedSize').value = selectedSize; // Cập nhật giá trị ẩn
            }

            // Cập nhật danh sách tồn kho và xác định stock hiện tại
            const stockList = document.getElementById('stock-list');
            stockList.innerHTML = '';

            let currentStock = 0; // Biến lưu số lượng tồn kho tương ứng
            let foundStock = false;

            productDetails.forEach(detail => {
                if ((selectedColor === null || detail.ma_mau_hex === selectedColor) &&
                    (selectedSize === null || detail.so_size === selectedSize)) {

                    const stockItem = document.createElement('li');
                    stockItem.textContent = `Màu: ${detail.ten_mau}, Size: ${detail.so_size}, Số lượng: ${detail.so_luong}`;
                    stockList.appendChild(stockItem);

                    // Ghi nhận stock tương ứng
                    currentStock = detail.so_luong;
                    foundStock = true;
                }
            });

            if (!foundStock) {
                const stockItem = document.createElement('li');
                stockItem.textContent = 'Số lượng: 0';
                stockList.appendChild(stockItem);
                currentStock = 0;
            }

            // Cập nhật giá trị stock vào trường ẩn
            document.getElementById('stockInput').value = currentStock;
        }



        document.getElementById('addToCartForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Ngăn form gửi đi theo cách mặc định

            // Thu thập dữ liệu từ form
            const formData = new FormData(this);

            // Gửi yêu cầu bằng fetch
            fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert(data.message); // Hiển thị thông báo lỗi từ server
                    } else {
                        alert(data.message); // Hiển thị thông báo thành công
                        // Có thể điều hướng hoặc cập nhật giao diện tại đây
                        window.location.reload();
                    }
                })
                .catch(error => {
                    console.error("Đã xảy ra lỗi:", error);
                    alert("Bạn chưa đăng nhập!");
                    window.location.href = "./?act=login"
                    // alert("Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng. Vui lòng thử lại.");
                });
        });
    </script>

    <!-- AI Summary Script -->
    <script src="<?= BASE_URL ?>assets/js/ai_summary.js?v=<?= time(); ?>"></script>

</body>

</html>