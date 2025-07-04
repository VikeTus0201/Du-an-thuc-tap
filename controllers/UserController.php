<?php
class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Khởi tạo session nếu chưa có
        }
    }

    // Hiển thị form đăng nhập
    public function loginForm()
    {
        
    }

    // Xử lý đăng nhập
    public function login()
    {
        require_once './views/login/login.php';
        $users = $this->userModel->getUser();
        
        // var_dump($users); die();
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $pass = $_POST['password'];
            foreach ($users as $user) {
                if ($email == $user['email'] && $pass == $user['mat_khau']) {
                    // session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['user_id'] = $user['id'];
                    if ($user['chuc_vu_id'] == 2) {
                        // var_dump($user); die();

                        header('Location: ' . BASE_URL);
                    } else {
                        header('Location: ./?act=login');
                    }
                }
            }
        }
        require_once './views/layout/footer.php';
    }

    // Xử lý đăng xuất
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL);
    }


    public function myCart(){
        require_once './views/cart/my_oders.php';
    }
}
