<!-- views/cart/my_orders.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="http://localhost/Thuctap/Project_thuc_tap/assets/css/cart/my_oders.css?v=<?= time(); ?>">
    <script src="http://localhost/Thuctap/Project_thuc_tap/assets/js/my_orders.js?v=<?= time(); ?>"></script>


</head>

<body>

    <?php require_once './views/layout/header.php'; ?>
    <div class="container">
        <h1>Track Orders</h1>

        <div class="order-tabs">
            <button class="tab-link active" onclick="showTab(event, 'cho_xac_nhan')">Pending Confirmation</button>
            <button class="tab-link" onclick="showTab(event, 'da_xac_nhan')">Confirmed</button>
            <button class="tab-link" onclick="showTab(event, 'dang_chuan_bi_hang')">Preparing Order</button>
            <button class="tab-link" onclick="showTab(event, 'dang_giao_hang')">Delivering</button>
            <button class="tab-link" onclick="showTab(event, 'da_giao_hang')">Delivered</button>
            <button class="tab-link" onclick="showTab(event, 'da_huy')">Cancelled</button></button>
        </div>

        <!-- Hiển thị danh sách đơn hàng cho từng trạng thái -->

        <!-- Modal cho Details đơn hàng -->
        <!-- Modal cho Details đơn hàng -->
        <div id="modal" style="display: none;">
            <div id="modal-content">
                <!-- Nội dung Details đơn hàng sẽ được thêm bằng JS -->
                <button class="close" onclick="document.getElementById('modal').style.display='none'">×</button>

            </div>
            <!-- Nút đóng phía dưới -->
            <button onclick="document.getElementById('modal').style.display='none'">Đóng</button>
        </div>


        <!-- Chờ xác nhận -->
        <div id="cho_xac_nhan" class="tab-content active">
            <div class="order-container">
                <?php
                // var_dump($orders);
                $status = false;
                $shownOrderIds = []; // Mảng lưu các order_id đã hiển thị

                foreach ($orders as $order):
                    if ($order['status'] === 'Pending Confirmation'):
                        if (!in_array($order['order_id'], $shownOrderIds)) {
                            $status = true;
                            $shownOrderIds[] = $order['order_id'];
                ?>
                            <div class="order">
                                <p>Order ID: <?= 'P' . $order['order_id'] ?></p>
                                <p>Order Date: <?= $order['order_date'] ?></p>
                                <p>Total: <?= number_format($order['total_amount'], 0, '.', '.') ?> VND</p>
                                <button class="btn-detail" data-order-id="<?= $order['order_id'] ?>">Details</button>
                                <form action="./?act=cancel-order" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                    <button type="submit" style="background-color: #dc3545;">Cancel Order</button>
                                </form>
                                <hr>
                            </div>

                    <?php
                        }
                    endif;
                endforeach;

                if ($status == false):
                    ?>
                    <h2>No orders found!</h2>
                <?php endif; ?>
            </div>
        </div>



        <!-- Modal -->
        <!-- <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Details đơn hàng</h3>
            <p id="orderDetails"></p>
        </div>
    </div> -->

        <!-- Đã xác nhận -->
        <div id="da_xac_nhan" class="tab-content">
            <div class="order-container">
                <?php
                $status = false;
                $shownOrderIds = []; // Mảng lưu các order_id đã hiển thị

                foreach ($orders as $order):
                    if ($order['status'] === 'Confirmed'):
                        // Kiểm tra nếu order_id chưa được hiển thị
                        if (!in_array($order['order_id'], $shownOrderIds)) {
                            $status = true;
                            // Lưu order_id vào mảng để tránh hiển thị lại
                            $shownOrderIds[] = $order['order_id'];
                ?>
                            <div class="order">
                                <p>Order ID: <?= 'P' . $order['order_id'] ?></p>
                                <p>Order Date: <?= $order['order_date'] ?></p>
                                <p>Total: <?= number_format($order['total_amount'], 0, '.', '.') ?> VND</p>
                                <button class="btn-detail" data-order-id="<?= $order['order_id'] ?>">Details</button>
                                <form action="./?act=cancel-order" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                    <!-- Gửi order_id qua POST -->
                                    <input type="hidden" name="order_id" value='<?= $order['order_id'] ?>'>
                                    <button type="submit" style="background-color: #dc3545;">Cancel Order</button>
                                </form>
                                <hr>
                            </div>
                    <?php
                        }
                    endif;
                endforeach;

                if ($status == false):
                    ?>
                    <h2>No orders found!</h2>
                <?php endif; ?>
            </div>
        </div>

        <!-- Đang chuẩn bị hàng -->
        <div id="dang_chuan_bi_hang" class="tab-content">
            <div class="order-container">
                <?php
                $status = false;
                $shownOrderIds = []; // Mảng lưu các order_id đã hiển thị

                foreach ($orders as $order):

                    if ($order['status'] === 'Preparing Order'):
                        // Kiểm tra nếu order_id chưa được hiển thị
                        if (!in_array($order['order_id'], $shownOrderIds)) {
                            $status = true;
                            // Lưu order_id vào mảng để tránh hiển thị lại
                            $shownOrderIds[] = $order['order_id'];
                ?>
                            <div class="order">
                                <p>Order ID: <?= 'P' . $order['order_id'] ?></p>
                                <p>Order Date: <?= $order['order_date'] ?></p>
                                <p>Total: <?= number_format($order['total_amount'], 0, '.', '.') ?> VND</p>
                                <button class="btn-detail" data-order-id="<?= $order['order_id'] ?>">Details</button>
                                <form action="./?act=cancel-order" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                    <!-- Gửi order_id qua POST -->
                                    <input type="hidden" name="order_id" value='<?= $order['order_id'] ?>'>
                                    <!-- <button type="submit">Hủy đơn hàng</button> -->
                                </form>
                                <hr>
                            </div>
                    <?php
                        }
                    endif;
                endforeach;

                if ($status == false):
                    ?>
                    <h2>No orders found!</h2>
                <?php endif; ?>
            </div>
        </div>

        <!-- Đang giao hàng -->
        <div id="dang_giao_hang" class="tab-content">
            <div class="order-container">
                <?php
                $status = false;
                $shownOrderIds = []; // Mảng lưu các order_id đã hiển thị

                foreach ($orders as $order):
                    if ($order['status'] === 'Delivering'):
                        // Kiểm tra nếu order_id chưa được hiển thị
                        if (!in_array($order['order_id'], $shownOrderIds)) {
                            $status = true;
                            // Lưu order_id vào mảng để tránh hiển thị lại
                            $shownOrderIds[] = $order['order_id'];
                ?>
                            <div class="order">
                                <p>Order ID: <?= 'P' . $order['order_id'] ?></p>
                                <p>Order Date: <?= $order['order_date'] ?></p>
                                <p>Total: <?= number_format($order['total_amount'], 0, '.', '.') ?> VND</p>
                                <button class="btn-detail" data-order-id="<?= $order['order_id'] ?>">Details</button>
                                <form action="./?act=cancel-order" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                    <!-- Gửi order_id qua POST -->
                                    <input type="hidden" name="order_id" value='<?= $order['order_id'] ?>'>
                                    <!-- <button type="submit">Hủy đơn hàng</button> -->
                                </form>
                                <hr>
                            </div>
                    <?php
                        }
                    endif;
                endforeach;

                if ($status == false):
                    ?>
                    <h2>No orders found!</h2>
                <?php endif; ?>
            </div>
        </div>

        <!-- Đã giao hàng -->
        <div id="da_giao_hang" class="tab-content">
            <div class="order-container">
                <?php
                $status = false;
                $shownOrderIds = []; // Mảng lưu các order_id đã hiển thị

                foreach ($orders as $order):
                    if ($order['status'] === 'Delivered'):
                        // Kiểm tra nếu order_id chưa được hiển thị
                        if (!in_array($order['order_id'], $shownOrderIds)) {
                            $status = true;
                            // Lưu order_id vào mảng để tránh hiển thị lại
                            $shownOrderIds[] = $order['order_id'];
                ?>
                            <div class="order">
                                <p>Order ID: <?= 'P' . $order['order_id'] ?></p>
                                <p>Order Date: <?= $order['order_date'] ?></p>
                                <p>Total: <?= number_format($order['total_amount'], 0, '.', '.') ?> VND</p>
                                <button class="btn-detail" data-order-id="<?= $order['order_id'] ?>">Details</button>
                                <form action="./?act=cancel-order" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                    <!-- Gửi order_id qua POST -->
                                    <input type="hidden" name="order_id" value='<?= $order['order_id'] ?>'>
                                    <!-- <button type="submit">Hủy đơn hàng</button> -->
                                </form>
                                <hr>
                            </div>
                    <?php
                        }
                    endif;
                endforeach;

                if ($status == false):
                    ?>
                    <h2>No orders found!</h2>
                <?php endif; ?>

            </div>
        </div>

        <!-- Đã hủy -->
        <div id="da_huy" class="tab-content">
            <div class="order-container">
                <?php
                $status = false;
                $shownOrderIds = []; // Mảng lưu các order_id đã hiển thị

                foreach ($orders as $order):
                    if ($order['status'] === 'Cancelled'):
                        // Kiểm tra nếu order_id chưa được hiển thị
                        if (!in_array($order['order_id'], $shownOrderIds)) {
                            $status = true;
                            // Lưu order_id vào mảng để tránh hiển thị lại
                            $shownOrderIds[] = $order['order_id'];
                ?>
                            <div class="order">
                                <p>Order ID: <?= 'P' . $order['order_id'] ?></p>
                                <p>Order Date: <?= $order['order_date'] ?></p>
                                <p>Total: <?= number_format($order['total_amount'], 0, '.', '.') ?> VND</p>
                                <button class="btn-detail" data-order-id="<?= $order['order_id'] ?>">Details</button>
                                <form action="./?act=cancel-order" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                    <!-- Gửi order_id qua POST -->
                                    <input type="hidden" name="order_id" value='<?= $order['order_id'] ?>'>
                                    <!-- <button type="submit">Hủy đơn hàng</button> -->
                                </form>
                                <hr>
                            </div>
                    <?php
                        }
                    endif;
                endforeach;

                if ($status == false):
                    ?>
                    <h2>Không có đơn hàng nào</h2>
                <?php endif; ?>

            </div>
        </div>

    </div>

    <?php require_once './views/layout/footer.php'; ?>
</body>

</html>