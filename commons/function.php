<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

// them file
function uploadFile($file, $folderUpload){
    $pathStorage = $folderUpload . time() . $file['name'];
    
    $from = $file['tmp_name'];
    $to = PATH_ROOT . $pathStorage;

    if (move_uploaded_file($from, $to)) {
        return $pathStorage;

    }
    return null;
}
// xoa file 
function deleteFile($file){
    $pathDelete = PATH_ROOT .$file;
    if (file_exists($pathDelete)) {
        unlink($pathDelete);
    }
}

function deleteSessionError(){
    if (isset($_SESSION['flash'])) {
// huy session sau khi đã tải lại trang
    unset($_SESSION['flash']);
    // session_unset();
    // session_destroy();
    }
    
}

function uploadFileAlbum($file, $folderUpload, $key){
    // Đảm bảo rằng thư mục tồn tại
    if (!is_dir(PATH_ROOT . $folderUpload)) {
        mkdir(PATH_ROOT . $folderUpload, 0755, true);
    }

    // Tạo tên tệp an toàn hơn
    $filename = time() . '_' . basename($file['name'][$key]);
    $pathStorage = $folderUpload . $filename;

    $from = $file['tmp_name'][$key];
    $to = PATH_ROOT . $pathStorage;

    // Kiểm tra lỗi tải lên
    if ($file['error'][$key] === UPLOAD_ERR_OK) {
        if (move_uploaded_file($from, $to)) {
            return $pathStorage;
        } else {
            error_log('Failed to move uploaded file.');
        }
    } else {
        error_log('Upload error code: ' . $file['error'][$key]);
    }

    return null;
}


function checkLoginAdmin() {
    if(!isset($_SESSION['user_admin'])) {
        header('location: ' . BASE_URL_ADMIN . '?act=login-admin');
        exit();
    }
}

// function displayMessage($message, $type = 'success') {
//     // Xác định kiểu hiển thị theo loại thông báo
//     $color = $type === 'success' ? 'green' : 'red';
    
//     echo "<p style='color: $color; font-weight: bold;'>$message</p>";
// }
