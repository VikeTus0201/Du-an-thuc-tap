<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Shoe Store</title>
    <link rel="stylesheet" href="http://localhost/Thuctap/Project_thuc_tap/assets/css/cart/cart.css?v=<?= time(); ?>">
    <script src="http://localhost/Thuctap/Project_thuc_tap/assets/js/cart.js?v=<?= time(); ?>"></script>
</head>

<body>
    <!-- Header -->
    <?php require_once './views/layout/header.php'; ?>

    <main class="container">
        <h1>Your Shopping Cart</h1>

        <div class="cart">
            <div class="cart-items">
                <table>
                    <thead>
                        <tr>
                            <!-- <th></th> -->
                            <th>Product</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="gio_hang">
                        <?php
                        $tong = 0;
                        // var_dump($cartItems);
                        if (!empty($cartItems)) {
                            foreach ($cartItems as $item):
                                $tong += $item['thanh_tien'];
                        ?>
                                <tr>
                                    <!-- <td><input type="checkbox" name="selected_items[]" value="<?= $item['cart_item_id']; ?>"></td> -->

                                    <td>
                                        <img src="<?= $item['hinh_anh']; ?>" alt="Product" style="width: 50px;">
                                        <span><?= $item['name']; ?></span>
                                    </td>
                                    <td><button style="background-color: <?= $item['mau_sac'] ?>; width: 30px; height: 30px;"></button></td>
                                    <td><?= $item['kich_thuoc'] ?></td>

                                    <td><?= number_format($item['price'], 0, '.', '.'); ?></td>
                                    <td>
                                        <!-- Input có thuộc tính max là số lượng tồn -->
                                        <form action="./?act=updateCart" method="POST" class="update-cart-form">
                                            <input type="hidden" name="cart_item_id" value="<?= $item['cart_item_id']; ?>" />
                                            <div class="quantity-control">
                                                <button type="button" class="decrement">-</button>
                                                <input type="number" name="quantity"
                                                    value="<?= $item['so_luong']; ?>"
                                                    min="1"
                                                    max="<?= $item['so_luong_ton']; ?>" />
                                                <button type="button" class="increment">+</button>
                                            </div>
                                        </form>
                                    </td>


                                    <td class="total-price"><?= number_format($item['thanh_tien'], 0, '.', '.'); ?> VNĐ</td>
                                    <td>
                                        <!-- Nút Xóa -->
                                        <button style="width: 70px; height: 40px; background-color: #dc3545; border: none; border-radius: 4px;"><a style="text-decoration: none; color: white;" href="index.php?act=deleteProduct&cartItemId=<?= $item['cart_item_id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Remove</a></button>
                                    </td>
                                </tr>
                            <?php endforeach;
                        } else { ?>
                            <tr>
                                <td colspan="5">Your cart is empty.</td>
                            </tr>
                        <?php } ?>
                    </tbody>

                </table>
                <!-- <?php if (!empty($cartItems)) { ?>
                    <button class="remove-item" style="margin-top:20px; height:30px">
                        <a style="text-decoration: none; color:white;" href="./?act=emty-cart&del-cart=1">Remove All</a>
                    </button>
                <?php } ?> -->

                <!-- Cart Summary -->
                <div class="cart-summary1">
                    <h2>Cart Summary</h2>
                    <div class="cart-summary">
                        <span>Subtotal</span>
                        <span><?= number_format($tong, 0, '.', '.'); ?> VNĐ</span>
                    </div>
                    <div class="summary-item">
                        <span>Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="total span">
                        <span>Total</span>
                        <span><?= number_format($tong, 0, '.', '.'); ?> VNĐ</span>
                    </div>
                    <div class="cart-actions">
                        <a href="./?act=view-products" class="checkout-btn">Continue Shopping</a>
                        <a href="./?act=pay" class="checkout-btn">Proceed to Checkout</a>
                    </div>
                </div>


            </div>
        </div>
    </main>

    <?php require_once './views/layout/footer.php'; ?>


</body>
<script>
    document.querySelectorAll('input[name="quantity"]').forEach(input => {
        input.addEventListener('input', function() {
            // Lấy giá trị tối đa từ thuộc tính max
            const maxQuantity = parseInt(this.getAttribute('max'), 10);
            const minQuantity = 1;
            let currentValue = parseInt(this.value, 10);

            // Kiểm tra nếu giá trị không hợp lệ hoặc vượt quá giới hạn
            if (isNaN(currentValue) || currentValue < minQuantity) {
                this.value = minQuantity; // Gán giá trị tối thiểu
            } else if (currentValue > maxQuantity) {
                this.value = maxQuantity; // Gán giá trị tối đa
            }
        });

        // Kiểm tra lại khi rời khỏi ô input
        input.addEventListener('blur', function() {
            const maxQuantity = parseInt(this.getAttribute('max'), 10);
            const minQuantity = 1;
            let currentValue = parseInt(this.value, 10);

            if (isNaN(currentValue) || currentValue < minQuantity) {
                alert('Số lượng không được nhỏ hơn 1!');
                this.value = minQuantity;
            } else if (currentValue > maxQuantity) {
                alert(`Số lượng không được vượt quá tồn kho: ${maxQuantity}`);
                this.value = maxQuantity;
            }
        });
    });

    document.querySelectorAll('.quantity-control').forEach(control => {
        const input = control.querySelector('input[name="quantity"]');
        const decrementBtn = control.querySelector('.decrement');
        const incrementBtn = control.querySelector('.increment');

        // Xử lý khi nhấn nút trừ
        decrementBtn.addEventListener('click', () => {
            let currentValue = parseInt(input.value, 10) || 1;
            const minValue = parseInt(input.min, 10) || 1;
            if (currentValue > minValue) {
                input.value = currentValue - 1;
                input.form.submit(); // Gửi form
            }
        });

        // Xử lý khi nhấn nút cộng
        incrementBtn.addEventListener('click', () => {
            let currentValue = parseInt(input.value, 10) || 1;
            const maxValue = parseInt(input.max, 10);
            if (currentValue < maxValue) {
                input.value = currentValue + 1;
                input.form.submit(); // Gửi form
            }
        });

        // Cập nhật trạng thái nút khi giá trị thay đổi
        input.addEventListener('input', () => {
            let currentValue = parseInt(input.value, 10) || 1;
            const minValue = parseInt(input.min, 10) || 1;
            const maxValue = parseInt(input.max, 10);

            decrementBtn.disabled = currentValue <= minValue;
            incrementBtn.disabled = currentValue >= maxValue;
        });
    });
</script>





</html>