<?php

class DangNhapController
{
    //kết nối đến fite model
    public $modelDangNhap;

    public function __construct()
    {
        $this->modelDangNhap = new DangNhap();
    }

    public function formlogin() {
        require_once './views/login/formlogin.php';
    
        if (isset($_SESSION['flash'])) {
            // Đặt chỉ thị flash để xóa session sau khi tải lại
            unset($_SESSION['flash']);
            session_destroy();
            require_once './views/login/formlogin.php';
    
            exit();
        }
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST['email'];
            $password = $_POST['password'];
            // var_dump($password); die;

            // Xử lí kiểm tra thông tin đăng nhập
            //check rong 

            $errors = [];
                if (empty($email)) {
                    $errors['email'] = 'Email là bắt buộc';
    
                }
                if (empty($password)) {
                    $errors['password'] = 'Password là bắt buộc';
    
                }
            
            if (empty($errors)) {
            $user = $this->modelDangNhap->checkLogin($email, $password);
            // var_dump($user);die;
            // unset($_SESSION['errors']);
            }else {
                // Lỗi lưu vào session
                $_SESSION['errors'] = $errors;

                header('Location:' . BASE_URL_ADMIN . '?act=login-admin');
                exit();
            }

            if ($user == $email) {

                $_SESSION['user_admin'] = $user;
                // var_dump($_SESSION['user_admin']); die();

                header('Location:' . BASE_URL_ADMIN . '?act=thongke');
                exit();
            } else {
                // Lỗi lưu vào session
                $_SESSION['errors'] = $user;
                // var_dump($_SESSION['error']); die();

                $_SESSION['flash'] = true;

                header('Location:' . BASE_URL_ADMIN . '?act=login-admin');
                exit();
            }
            
        }
    }


    public function logout()
    {
        
        // var_dump($_SESSION['user_admin']);die;
        if (isset($_SESSION['user_admin'])) {
            unset($_SESSION['user_admin']);
            session_destroy();
            
            header('location:' . BASE_URL_ADMIN . '?act=login-admin');
        }
       
    }
    


}