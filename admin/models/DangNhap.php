<?php

class DangNhap
{
    public $conn;

    //kết nối CSDL

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function checkLogin($email, $mat_khau)
    {

        // if (empty($email)) {
        //     return 'Email không được để trống';
        // }
    
        // if (empty($mat_khau)) {
        //     return 'Mật khẩu không được để trống';
        // }
        
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($mat_khau == $user['mat_khau']) {
                if ($user['chuc_vu_id'] == 1) {

                    if ($user['trang_thai'] == 1) {
                        return $user['email']; // truong hop thanh cong 
                    }
                     else {
                        
                        return 'Tài khoản bị cấm';
                    }
                } else {
                    return 'Tài khoản không có quyền đăng nhập';
                }
            } else {
                return 'Đăng nhập sai thông tin mật khẩu hoặc tài khoản';
            }
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }


}