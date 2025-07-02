<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Đăng Ký</title>
    <style>
        /* Reset mặc định */
        body, h1, h2, p, input, button, a {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            /* background: linear-gradient(135deg, #6a11cb, #2575fc); */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            color: #fff;
        }

        .register-form {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }

        .register-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4a4a4a;
            font-size: 28px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: #2575fc;
            box-shadow: 0 0 8px rgba(37, 117, 252, 0.2);
            outline: none;
        }

        input[type="file"] {
            padding: 5px;
            background: transparent;
            border: none;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            background: #2575fc;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background: #1a5bcc;
            transform: translateY(-2px);
        }

        .btn:active {
            transform: translateY(0);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer p {
            font-size: 14px;
            color: #555;
        }

        .form-footer a {
            color: #2575fc;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .form-footer a:hover {
            color: #1a5bcc;
        }
    </style>
</head>
<body>
    <div class="register-form">
        <h2>Đăng Ký</h2>
        <form action="?act=xu-li-dang-ki" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="ho_ten">Họ và Tên</label>
                <input type="text" id="ho_ten" name="ho_ten" placeholder="Nhập họ và tên" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Nhập email" required>
            </div>
            <div class="form-group">
                <label for="ngay_sinh">Ngày sinh</label>
                <input type="date" id="ngay_sinh" name="ngay_sinh" required>
            </div>
            <div class="form-group">
                <label for="dia_chi">Địa chỉ</label>
                <input type="text" id="dia_chi" name="dia_chi" placeholder="Nhập địa chỉ" required>
            </div>
            <div class="form-group">
                <label for="avata">Ảnh đại diện</label>
                <input type="file" id="avata" name="avata">
            </div>
            <div class="form-group">
                <label for="so_dien_thoai">Số điện thoại</label>
                <input type="number" id="so_dien_thoai" name="so_dien_thoai" placeholder="Nhập số điện thoại" required>
            </div>
            <div class="form-group">
                <label for="mat_khau">Mật khẩu</label>
                <input type="password" id="mat_khau" name="mat_khau" placeholder="Nhập mật khẩu" required>
            </div>
            <button type="submit" class="btn">Đăng Ký</button>
        </form>
        <div class="form-footer">
            <p>Bạn đã có tài khoản? <a href="./?act=login">Đăng nhập</a></p>
        </div>
    </div>
</body>
</html>
