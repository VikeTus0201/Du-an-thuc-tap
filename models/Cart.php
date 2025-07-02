<?php
class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = connectDB(); // Kết nối cơ sở dữ liệu
    }

    // Lấy các sản phẩm trong giỏ hàng
    public function getCartItemsByUserId($userId)
    {
        $query = "
        SELECT 
            ctgh.id AS cart_item_id,
            sp.id AS product_id,
            sp.ten_san_pham AS name,
            sp.hinh_anh,
            sp.gia_ban AS price,
            ctgh.so_luong,
            (ctgh.so_luong * sp.gia_ban) AS thanh_tien
        FROM chi_tiet_gio_hangs ctgh
        INNER JOIN san_phams sp ON ctgh.san_pham_id = sp.id
        INNER JOIN gio_hangs gh ON ctgh.gio_hang_id = gh.id
        WHERE gh.nguoi_dung_id = ?
    ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Tính tổng giá trị giỏ hàng
    // public function getTotalPrice($gioHangId)
    // {
    //     $query = "
    //         SELECT SUM(ctg.so_luong * ctg.gia_mua) AS total_price
    //         FROM chi_tiet_gio_hangs ctg
    //         WHERE ctg.gio_hang_id = :gioHangId
    //     ";

    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':gioHangId', $gioHangId);
    //     $stmt->execute();

    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $result['total_price'] ?? 0;
    // }

    // user
    public function getUser()
    {
        $query = "SELECT * FROM tai_khoans WHERE trang_thai = 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Thêm sản phẩm vào giỏ hàng
    public function addProductToCart($userId, $productId, $soLuong, $stock, $selectedColor, $selectedSize)
    {
        // Kiểm tra xem người dùng đã có giỏ hàng chưa
        $query = "SELECT id FROM gio_hangs WHERE nguoi_dung_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$userId]);
        $cart = $stmt->fetch(); 

        // Nếu chưa có giỏ hàng, tạo mới
        if (!$cart) { 
            $query = "INSERT INTO gio_hangs (nguoi_dung_id) VALUES (?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$userId]);
            $cartId = $this->db->lastInsertId();
        } else {
            $cartId = $cart['id'];
        }

        // Kiểm tra xem sản phẩm đã có trong chi tiết giỏ hàng chưa
        $query = "SELECT id, so_luong FROM chi_tiet_gio_hangs WHERE gio_hang_id = ? AND san_pham_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$cartId, $productId]);
        $result = $stmt->fetch();

        if ($result) {
            // Nếu sản phẩm đã có, cập nhật số lượng và thành tiền
            $query = "UPDATE chi_tiet_gio_hangs 
                  SET so_luong = so_luong + ?, thanh_tien = thanh_tien + (? * (SELECT gia_ban FROM san_phams WHERE id = ?))
                  WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$soLuong, $soLuong, $productId, $result['id']]);
        } else {
            // Nếu chưa có, thêm mới với giá trị thanh_tien
            $query = "INSERT INTO chi_tiet_gio_hangs (gio_hang_id, san_pham_id, so_luong, so_luong_ton, gia_ban, thanh_tien, mau_sac, kich_thuoc) 
                  VALUES (?, ?, ?, ?, (SELECT gia_ban FROM san_phams WHERE id = ?), ? * (SELECT gia_ban FROM san_phams WHERE id = ?), ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$cartId, $productId, $soLuong, $stock, $productId, $soLuong,$productId, $selectedColor, $selectedSize]);
        }
    }



    // Phương thức thêm chi tiết sản phẩm vào giỏ hàng
    // public function addProductToCart($cartId, $productId, $quantity, $price)
    // {
    //     // Tính thành tiền
    //     $totalPrice = $quantity * $price;

    //     $sql = "INSERT INTO chi_tiet_gio_hangs (gio_hang_id, san_pham_id, so_luong, gia_ban, thanh_tien)
    //             VALUES (?, ?, ?, ?, ?)";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->execute([$cartId, $productId, $quantity, $price, $totalPrice]);
    // }


    public function pay($gioHangId, $paymentMethod)
    {
        try {
            // Bắt đầu giao dịch
            $this->db->beginTransaction();

            // Kiểm tra người dùng đã đăng nhập
            if (!isset($_SESSION['user_id'])) {
                header('Location: ./login.php'); // Chuyển hướng nếu chưa đăng nhập
                exit();
            }
            $user_id = $_SESSION['user_id'];

            // Lấy thông tin người dùng
            $sql_user = "SELECT ho_ten, so_dien_thoai, dia_chi FROM tai_khoans WHERE id = ?";
            $stmt_user = $this->db->prepare($sql_user);
            $stmt_user->execute([$user_id]);
            $user_info = $stmt_user->fetch(PDO::FETCH_ASSOC);

            if (!$user_info) {
                throw new Exception('Người dùng không tồn tại.');
            }

            // Lấy thông tin giỏ hàng
            $sql_cart = "
            SELECT ctgh.chi_tiet_san_pham_id, sp.ten_san_pham, sp.gia_ban, ctgh.so_luong, 
                   (sp.gia_ban * ctgh.so_luong) AS thanh_tien
            FROM chi_tiet_gio_hangs ctgh
            JOIN san_pham_chi_tiet ctsp ON ctgh.chi_tiet_san_pham_id = ctsp.id
            JOIN san_pham sp ON ctsp.san_pham_id = sp.id
            WHERE ctgh.gio_hang_id = ?
        ";
            $stmt_cart = $this->db->prepare($sql_cart);
            $stmt_cart->execute([$gioHangId]);
            $cart_items = $stmt_cart->fetchAll(PDO::FETCH_ASSOC);

            if (empty($cart_items)) {
                throw new Exception('Giỏ hàng trống.');
            }

            // Tính tổng giá trị giỏ hàng
            $total_amount = array_sum(array_column($cart_items, 'thanh_tien'));

            // Tạo đơn hàng mới
            $sql_order = "
            INSERT INTO don_hangs (nguoi_dung_id, tong_tien, phuong_thuc_thanh_toan, ngay_tao) 
            VALUES (?, ?, ?, NOW())
        ";
            $stmt_order = $this->db->prepare($sql_order);
            $stmt_order->execute([$user_id, $total_amount, $paymentMethod]);
            $order_id = $this->db->lastInsertId();

            // Thêm chi tiết đơn hàng
            $sql_order_details = "
            INSERT INTO chi_tiet_don_hangs (don_hang_id, chi_tiet_san_pham_id, so_luong, gia_ban) 
            VALUES (?, ?, ?, ?)
        ";
            $stmt_order_details = $this->db->prepare($sql_order_details);

            foreach ($cart_items as $item) {
                $stmt_order_details->execute([
                    $order_id,
                    $item['chi_tiet_san_pham_id'],
                    $item['so_luong'],
                    $item['gia_ban']
                ]);
            }

            // Xóa giỏ hàng sau khi thanh toán
            $sql_clear_cart = "DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id = ?";
            $stmt_clear_cart = $this->db->prepare($sql_clear_cart);
            $stmt_clear_cart->execute([$gioHangId]);

            // Commit giao dịch
            $this->db->commit();

            // Trả thông tin thanh toán cho giao diện
            return [
                'status' => 'success',
                'order_id' => $order_id,
                'user_info' => $user_info,
                'total_amount' => $total_amount,
                'cart_items' => $cart_items,
            ];
        } catch (Exception $e) {
            // Rollback nếu có lỗi
            $this->db->rollBack();
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function getCartByUserId($user_id)
    {
        $sql = "
        SELECT sp.id AS san_pham_id, sp.ten_san_pham, sp.gia_ban, ctgh.so_luong, (sp.gia_ban * ctgh.so_luong) AS thanh_tien
        FROM chi_tiet_gio_hangs ctgh
        JOIN san_phams sp ON ctgh.san_pham_id = sp.id
        WHERE ctgh.gio_hang_id = (
            SELECT id 
            FROM gio_hangs 
            WHERE nguoi_dung_id = ? 
            LIMIT 1
        )
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function clearCart($userId)
    {
        $query = "
        DELETE FROM chi_tiet_gio_hangs
        WHERE gio_hang_id = (SELECT id FROM gio_hangs WHERE nguoi_dung_id = :userId)
    ";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }

    public function createOrderDetail($orderId, $productName, $price, $quantity, $totalPrice)
    {
        $query = "
        INSERT INTO chi_tiet_don_hangs (don_hang_id, ten_san_pham, gia_ban, so_luong, thanh_tien)
        VALUES (:orderId, :productName, :price, :quantity, :totalPrice)
    ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':orderId', $orderId);

        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':totalPrice', $totalPrice);

        $stmt->execute();
    }


    public function createOrder($userId, $fullName, $phoneNumber, $address, $totalAmount, $paymentMethod, $orderStatusId = 1)
    {
        $query = "
        INSERT INTO don_hangs (nguoi_dung_id, ho_ten, so_dien_thoai, dia_chi, tong_tien, phuong_thuc_thanh_toan, trang_thai_id, ngay_tao)
        VALUES (:userId, :fullName, :phoneNumber, :address, :totalAmount, :paymentMethod, :orderStatusId, NOW())
    ";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':fullName', $fullName);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':totalAmount', $totalAmount);
        $stmt->bindParam(':paymentMethod', $paymentMethod);
        $stmt->bindParam(':orderStatusId', $orderStatusId);

        $stmt->execute();

        // Trả về ID của đơn hàng vừa tạo
        return $this->db->lastInsertId();
    }


    // Phương thức kiểm tra và lấy giỏ hàng của người dùng
    public function getCartIdByUserId($userId)
    {
        $sql = "SELECT id FROM gio_hangs WHERE nguoi_dung_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetchColumn();
    }

    // Phương thức tạo giỏ hàng mới nếu chưa có
    public function createCart($userId)
    {
        $sql = "INSERT INTO gio_hangs (nguoi_dung_id) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $this->db->lastInsertId();  // Trả về ID giỏ hàng mới
    }


    public function updateQuantity($cartItemId, $quantity)
    {
        $sql = "UPDATE chi_tiet_gio_hangs 
            SET so_luong = :so_luong, thanh_tien = price * :so_luong 
            WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':so_luong', $quantity, PDO::PARAM_INT);
        $stmt->bindValue(':id', $cartItemId, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function getCartSummary($userId)
    {
        // Lấy thông tin tổng giỏ hàng của người dùng, tính tổng tiền
        $sql = "SELECT SUM(ctg.thanh_tien) AS tong
            FROM chi_tiet_gio_hangs ctg
            INNER JOIN gio_hangs gh ON ctg.cart_id = gh.cart_id
            WHERE gh.user_id = :user_id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    // public function deleteCartItem($cartItemId)
    // {
    //     $sql = "DELETE FROM chi_tiet_gio_hangs WHERE id = :id";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bindValue(':id', $cartItemId, PDO::PARAM_INT);
    //     return $stmt->execute();
    // }


    // CartController.php

    // Lấy các sản phẩm trong giỏ hàng của người dùng
    public function getCartItems($userId)
    {
        $sql = "
        SELECT 
            ctgh.id AS cart_item_id, 
            sp.ten_san_pham AS name, 
            sp.gia_ban AS price, 
            sp.hinh_anh AS hinh_anh, 
            ctgh.so_luong AS so_luong, 
            ctgh.mau_sac,
            ctgh.kich_thuoc,
            ctgh.so_luong_ton,
            (ctgh.so_luong * sp.gia_ban) AS thanh_tien
        FROM chi_tiet_gio_hangs ctgh
        JOIN san_phams sp ON ctgh.san_pham_id = sp.id
        JOIN gio_hangs gh ON ctgh.gio_hang_id = gh.id
        WHERE gh.nguoi_dung_id = :nguoi_dung_id
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['nguoi_dung_id' => $userId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getOrderDetailsById($orderId)
    {
        // Truy vấn lấy chi tiết đơn hàng
        $sql = "
            SELECT 
                o.id AS order_id, 
                o.ngay_tao AS order_date, 
                o.tong_tien AS total_amount, 
                o.phuong_thuc_thanh_toan AS pttt,
                o.ho_ten,
                o.so_dien_thoai AS sdt,
                o.dia_chi,
                t.ten_trang_thai AS status,
                cd.ten_san_pham AS product_name, 
                cd.so_luong AS quantity
            FROM 
                don_hangs o
            JOIN 
                chi_tiet_don_hangs cd ON o.id = cd.don_hang_id
            JOIN 
                trang_thais t ON o.trang_thai_id = t.id
            WHERE 
                o.id = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$orderId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results)) {
            return [
                'order_id' => $results[0]['order_id'],
                'order_date' => $results[0]['order_date'],
                'total_amount' => $results[0]['total_amount'],
                'pttt' => $results[0]['pttt'],
                'ho_ten' => $results[0]['ho_ten'],
                'sdt' => $results[0]['sdt'],
                'dia_chi' => $results[0]['dia_chi'],
                'status' => $results[0]['status'],
                'products' => array_map(function ($row) {
                    return [
                        'product_name' => $row['product_name'],
                        'quantity' => $row['quantity']
                    ];
                }, $results)
            ];
        }

        return null; // Không tìm thấy
    }





    public function deleteProductFromCart($cartItemId)
    {
        $query = "DELETE FROM chi_tiet_gio_hangs WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$cartItemId]);
    }

    // Lấy tổng giá trị giỏ hàng
    public function getCartTotal()
    {
        $sql = "SELECT SUM(thanh_tien) AS total FROM chi_tiet_gio_hangs";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Cập nhật số lượng sản phẩm trong giỏ
    public function updateProductQuantity($cartItemId, $quantity)
    {
        // Truy vấn để cập nhật số lượng
        $sql = "UPDATE chi_tiet_gio_hangs SET so_luong = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$quantity, $cartItemId]);
    }

    // Lấy danh sách đơn hàng của người dùng theo user_id
    public function getOrdersByUserId($userId)
    {
        // Truy vấn lấy danh sách đơn hàng của người dùng
        $sql = "
            SELECT 
                o.id AS order_id, 
                o.ngay_tao AS order_date, 
                o.tong_tien AS total_amount, 
                o.phuong_thuc_thanh_toan,
                o.ho_ten,
                o.so_dien_thoai,
                t.ten_trang_thai AS status, 
                p.ten_san_pham AS product_name, 
                cd.so_luong AS quantity, 
                cd.gia_ban AS price
            FROM 
                don_hangs o
            JOIN 
                chi_tiet_don_hangs cd 
                ON o.id = cd.don_hang_id
            JOIN 
                san_phams p 
                ON cd.ten_san_pham = p.ten_san_pham
            JOIN 
                trang_thais t 
                ON o.trang_thai_id = t.id
            WHERE 
                o.nguoi_dung_id = ?
            ORDER BY 
                o.ngay_tao DESC
        ";



        // Chuẩn bị và thực thi truy vấn
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);

        // Lấy kết quả trả về dưới dạng mảng
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Phương thức hủy đơn hàng
    public function cancelOrder($orderId)
    {
        // Giả sử có bảng 'don_hangs' và trường 'trang_thai' để cập nhật trạng thái đơn hàng
      

        // Thực hiện câu lệnh SQL để cập nhật trạng thái đơn hàng thành 'Đã hủy'
        $query = "UPDATE don_hangs SET trang_thai_id = 6 WHERE id = :order_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);

        return $stmt->execute();  // Trả về true nếu thành công, false nếu thất bại
    }
















}
