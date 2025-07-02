<?php
class CartController
{
    private $cartModel;
    private $userId;

    public function __construct()
    {
        $this->cartModel = new Cart(); // Khởi tạo mô hình Home
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Khởi tạo session nếu chưa có
            $this->userId = $_SESSION['user_id'];
        }
    }

    // Xem giỏ hàng
    // Hiển thị giỏ hàng
    public function viewCart()
    {
        $userId = $_SESSION['user_id'] ?? null; // Kiểm tra nếu người dùng đã đăng nhập
        if (!$userId) {
            header('Location: ./?act=login');
            exit;
        }

        $cartItems = $this->cartModel->getCartItems($userId);
        require_once './views/cart/cart.php'; // Hiển thị view giỏ hàng
    }

    // Cập nhật số lượng sản phẩm
    // public function updateCart()
    // {
    //     $cartItemId = $_POST['cart_item_id'] ?? null;
    //     $quantity = $_POST['so_luong'] ?? null;

    //     if (!$cartItemId || !$quantity) {
    //         echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ.']);
    //         return;
    //     }

    //     if ($this->cartModel->updateCartItem($cartItemId, $quantity)) {
    //         echo json_encode(['success' => true]);
    //     } else {
    //         echo json_encode(['success' => false, 'message' => 'Không thể cập nhật sản phẩm.']);
    //     }
    // }

    // // Xóa một sản phẩm khỏi giỏ hàng
    // public function deleteCartItem()
    // {
    //     $cartItemId = $_GET['cart_item_id'] ?? null;

    //     if (!$cartItemId) {
    //         echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ.']);
    //         return;
    //     }

    //     if ($this->cartModel->deleteCartItem($cartItemId)) {
    //         echo json_encode(['success' => true]);
    //     } else {
    //         echo json_encode(['success' => false, 'message' => 'Không thể xóa sản phẩm.']);
    //     }
    // }

    // Xóa toàn bộ giỏ hàng
    public function clearCart()
    {
        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            echo json_encode(['success' => false, 'message' => 'Bạn chưa đăng nhập.']);
            return;
        }

        if ($this->cartModel->clearCart($userId)) {
            header('Location: ./?act=view-cart');
        } else {
            echo json_encode(['success' => false, 'message' => 'Không thể xóa giỏ hàng.']);
        }
    }




    // Thêm sản phẩm vào giỏ hàng
    public function addToCart()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            echo "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!";
            header('Location: ./?act=login');
            exit;
        }

        // Lấy ID người dùng từ session
        $userId = $_SESSION['user_id'];

        // Khởi tạo session giỏ hàng nếu chưa có
        if (!isset($_SESSION['gio_hang'])) {
            $_SESSION['gio_hang'] = [];
        }

        // Kiểm tra phương thức gửi dữ liệu
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Nhận dữ liệu từ form
            $productId = $_POST['id'] ?? null;
            $productName = $_POST['ten_san_pham'] ?? null;
            $price = $_POST['gia_ban'] ?? null;
            $hinh_anh = $_POST['hinh_anh'] ?? null;
            $so_luong = isset($_POST['so_luong']) && $_POST['so_luong'] > 0 ? (int)$_POST['so_luong'] : 1;
            $mau_sac = $_POST['selectedColor'] ?? null;
            $kich_thuoc = $_POST['selectedSize'] ?? null;
            $soLuongTon = $_POST['stock'] ?? 0;

            $response = ['success' => false, 'message' => ''];

            $soLuongMua = $_POST['so_luong'];
            $stock = $_POST['stock'];
            $selectedColor = $_POST['selectedColor'];
            $selectedSize = $_POST['selectedSize'];

            if ($stock <= 0) {
                $response['message'] = "Sản phẩm đã hết hàng. Vui lòng chọn sản phẩm khác.";
                echo json_encode($response);
                exit;
            }

            if (!$selectedColor) {
                $response['message'] = "Vui lòng chọn màu sắc trước khi thêm vào giỏ hàng.";
                echo json_encode($response);
                exit;
            }

            if (!$selectedSize) {
                $response['message'] = "Vui lòng chọn kích thước trước khi thêm vào giỏ hàng.";
                echo json_encode($response);
                exit;
            }

            if ($soLuongMua > $stock) {
                $response['message'] = "Số lượng mua vượt quá số lượng tồn kho ($stock). Vui lòng giảm số lượng.";
                echo json_encode($response);
                exit;
            }

            
 
            

            // Kiểm tra tính hợp lệ của dữ liệu
            if (!$productId || !$productName || !$price || !$hinh_anh) {
                echo "Dữ liệu không hợp lệ!";
                exit;
            }
// var_dump($userId, $productId, $so_luong, $stock, $selectedColor, $selectedSize); die();
            // Gọi Model để thêm sản phẩm vào giỏ hàng trong CSDL
            $cartModel = new Cart();
            $cartModel->addProductToCart($userId, $productId, $so_luong, $stock, $selectedColor, $selectedSize);
            

            // Cập nhật session giỏ hàng
            $productExists = false;
            foreach ($_SESSION['gio_hang'] as $key => $value) {
                if ($value['id'] == $productId) {
                    $productExists = true;
                    $_SESSION['gio_hang'][$key]['so_luong'] += $so_luong;
                    break;
                }
            }

            // Nếu sản phẩm chưa có trong session giỏ hàng, thêm mới
            if (!$productExists) {
                $item = [
                    'id' => $productId,
                    'name' => $productName,
                    'price' => $price,
                    'hinh_anh' => $hinh_anh,
                    'so_luong' => $so_luong
                ];
                $_SESSION['gio_hang'][] = $item;
            }

            // Xử lý thêm vào giỏ hàng
            $response['success'] = true;
            $response['message'] = "Thêm sản phẩm vào giỏ hàng thành công.";
            echo json_encode($response);
            exit;


            // Điều hướng về trang giỏ hàng
            header('Location: ./?act=my-cart');
            exit;
        }
    }

    // Xoá sản phẩm khỏi giỏ hàng
    public function removeFromCart()
    {
        if (isset($_GET['del-key'])) {
            $delKey = $_GET['del-key'];
            // var_dump($delKey); die();

            // Kiểm tra và xoá sản phẩm trong giỏ hàng
            if (isset($_SESSION['gio_hang'][$delKey])) {
                unset($_SESSION['gio_hang'][$delKey]);
                echo "Item removed successfully."; 
            }else{
                echo "Item not found.";
            }

            // Chuyển hướng về trang giỏ hàng sau khi xoá sản phẩm
            header("Location: ./?act=my-cart");
            exit();
        }
    }
    public function handleRequest() {
    // Kiểm tra nếu có yêu cầu xoá sản phẩm
    if (isset($_GET['act']) && $_GET['act'] == 'del-product') {
        // Nếu có tham số del-key, gọi phương thức xoá sản phẩm
        if (isset($_GET['del-key'])) {
            $this->removeFromCart();
        } else {
            $this->viewCart();
        }
    }

    // Kiểm tra nếu có yêu cầu thêm sản phẩm vào giỏ
    if (isset($_GET['act']) && $_GET['act'] == 'add-to-cart') {
        $this->addToCart();
  
    }
}
   
// public function emtyCart(){
//         if (isset($_GET['act']) && $_GET['act'] == 'emty-cart') {
//             // Nếu có tham số del-key, gọi phương thức xoá sản phẩm
//             if (isset($_GET['del-cart'])&& ($_GET['del-cart'])==1) {
//                 $_SESSION['gio_hang'] = [];
//                 header("Location: ./?act=my-cart");
//             } 
// }

    
// }




    public function showPaymentPage()
    {


        // Kiểm tra người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            header('Location: ./?act=login');
            exit();
        }

        $user_id = $_SESSION['user_id'];

        // Lấy thông tin người dùng
        $userModel = new User();
        $user_info = $userModel->getUserById($user_id);

        // Lấy thông tin giỏ hàng
        $cartModel = new Cart();
        $cart_items = $cartModel->getCartByUserId($user_id);
        // var_dump($cart_items); die;

        $total_amount = array_sum(array_column($cart_items, 'thanh_tien'));

        // Gửi dữ liệu đến view
        require_once './views/cart/pay.php';
    }


    public function processPayment()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            header('Location: ./?act=login');
            exit();
        }

        $userId = $_SESSION['user_id'];

        // Lấy thông tin từ form
        $fullName = $_POST['full_name'];
        $phoneNumber = $_POST['phone_number'];
        $address = $_POST['address'];
        $paymentMethod = $_POST['payment_method'];

        // Lấy thông tin giỏ hàng
        $cartModel = new Cart();
        $cartItems = $cartModel->getCartByUserId($userId);

        if (empty($cartItems)) {
            // Nếu giỏ hàng trống, chuyển hướng về trang giỏ hàng
            header('Location: ./?act=my-cart');
            exit();
        }

        // Tính tổng số tiền
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item['thanh_tien'];
        }

        // Lưu thông tin vào bảng `don_hangs`
        $orderId = $cartModel->createOrder($userId, $fullName,
                $phoneNumber,
                $address,
                $totalAmount,
                $paymentMethod,
                1
            );
        // $orderId = $cartModel->createOrder($userId, $fullName, $phoneNumber, $address, $totalAmount, $paymentMethod, 1);




        // Lưu thông tin vào bảng `chi_tiet_don_hangs`
        foreach ($cartItems as $item) {
            $cartModel->createOrderDetail($orderId, $item['ten_san_pham'], $item['gia_ban'], $item['so_luong'], $item['thanh_tien']);
        }

        // Xóa giỏ hàng sau khi thanh toán thành công
        $cartModel->clearCart($userId); 

        // Chuyển hướng đến trang xác nhận
        header('Location: ./?act=payment-success');
    }

    // Thanh toán thành công
    public function paymentSuccess(){
        require_once './views/cart/payment_success.php';
    }

    public function deleteProduct()
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (!isset($_SESSION['user_id'])) {
            header('Location: ./?act=login'); // Chuyển hướng nếu chưa đăng nhập
            exit();
        }

        $userId = $_SESSION['user_id'];
        $cartItemId = $_GET['cartItemId'] ?? null;

        if (!$cartItemId) {
            // Trường hợp không có cartItemId được truyền vào
            header('Location: ./?act=my-cart');
            exit();
        }

        // Gọi phương thức deleteProductFromCart từ model
        $result = (new Cart())->deleteProductFromCart($cartItemId);

        if ($result) {
            // Chuyển hướng về giỏ hàng sau khi xóa thành công
            header('Location: ./?act=my-cart');
            exit();
        } else {
            // Nếu có lỗi xảy ra
            echo "Không thể xóa sản phẩm. Vui lòng thử lại!";
        }
    }


    // Hàm xử lý cập nhật số lượng sản phẩm trong giỏ
    public function updateCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_item_id']) && isset($_POST['quantity'])) {
            $cartItemId = $_POST['cart_item_id'];
            $quantity = $_POST['quantity'];

            // Kiểm tra số lượng hợp lệ
            if ($quantity <= 0) {
                echo "<script>alert('Số lượng phải lớn hơn 0'); window.location='index.php?act=my-cart';</script>";
                exit();
            }

            // Cập nhật số lượng trong giỏ hàng
            $cartModel = new Cart();
            if ($cartModel->updateProductQuantity($cartItemId, $quantity)) {
                // Cập nhật thành công, quay lại trang giỏ hàng
                header("Location: index.php?act=my-cart");
                exit();
            } else {
                echo "<script>alert('Cập nhật không thành công'); window.location='index.php?act=my-cart';</script>";
            }
        }
    }

    // Hàm huỷ đơn hàng
    public function cancelOrder()
    {
        // Lấy order_id từ POST
        $orderId = $_POST['order_id'] ?? null;

        if ($orderId) {
            $result = $this->cartModel->cancelOrder($orderId);
            if ($result) {
                // Chuyển hướng về trang danh sách đơn hàng sau khi hủy thành công
                header('Location: ./?act=my-order');
                exit();
            } else {
                echo "Không thể hủy đơn hàng. Vui lòng thử lại!";
            }
        } else {
            echo "Không tìm thấy đơn hàng.";
        }
    }




    // Hàm hiển thị danh sách đơn hàng của người dùng
    public function showOrders()
    {
        // Lấy thông tin người dùng đang đăng nhập
        $userId = $_SESSION['user_id'];  // Giả sử bạn lưu user_id trong session sau khi đăng nhập

        // Lấy danh sách đơn hàng từ model
     
        $orders = $this->cartModel->getOrdersByUserId($userId);

        // var_dump($orders);

        // Gọi view để hiển thị danh sách đơn hàng
        require_once './views/cart/my_orders.php';
    }

    public function getOrderDetails()
    {
        if (!isset($_GET['order_id'])) {
            echo json_encode(['error' => 'Không tìm thấy mã đơn hàng.']);
            return;
        }

        $orderId = intval($_GET['order_id']); // Lấy order_id từ query string
        $orderDetails = $this->cartModel->getOrderDetailsById($orderId);

        if (!$orderDetails) {
            echo json_encode(['error' => 'Không tìm thấy chi tiết đơn hàng.']);
        } else {
            echo json_encode($orderDetails);
        }
       
        
    }






















}


?>