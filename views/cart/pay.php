<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - PRIME Store</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/cart/pay.css?v=<?= time(); ?>">
</head>

<body>
    <?php require_once './views/layout/header.php'; ?>

    <div class="container">
        <h1>Payment</h1>
        <form action="./?act=process-payment" method="post" class="payment-form">

            <!-- Shipping Information -->
            <section class="shipping-info">
                <h2>Shipping Information</h2>
                <div class="form-group">
                    <label for="full-name">Full Name</label>
                    <input type="text" id="full-name" name="full_name" value="<?= htmlspecialchars($user_info['ho_ten']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone-number">Phone Number</label>
                    <input type="tel" id="phone-number" name="phone_number" value="<?= htmlspecialchars($user_info['so_dien_thoai']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Shipping Address</label>
                    <input type="text" id="address" name="address" value="<?= htmlspecialchars($user_info['dia_chi']); ?>" required>
                </div>
            </section>

            <!-- Order Details -->
            <section class="order-details">
                <h2>Order Details</h2>
                <table class="order-summary">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // var_dump($cart_items);
                        foreach ($cart_items as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['ten_san_pham']); ?></td>
                                <td><?= number_format($item['gia_ban'], 0, ',', '.'); ?> VND</td>
                                <td><?= $item['so_luong']; ?></td>
                                <td><?= number_format($item['thanh_tien'], 0, ',', '.'); ?> VND</td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="total-row">
                            <td colspan="3">Total</td>
                            <td><?= number_format($total_amount, 0, ',', '.'); ?> VND</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <!-- Payment Method -->
            <section class="payment-method">
                <h2>Select Payment Method</h2>
                <div class="payment-option">
                    <label for="payment-cash">Cash on Delivery</label>
                    <input type="radio" id="payment-cash" name="payment_method" value="cash_on_delivery" required>
                </div>
            </section>

            <!-- Confirmation -->
            <section class="confirm-section">
                <button type="submit" class="btn-confirm">Confirm Payment</button>
            </section>

        </form>
    </div>

    <?php require_once './views/layout/footer.php'; ?>
</body>

</html>