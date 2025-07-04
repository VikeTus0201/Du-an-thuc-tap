# Hướng dẫn cấu hình AI Summary với Gemini API

## Bước 1: Lấy API Key từ Google AI Studio

1. Truy cập: https://makersuite.google.com/app/apikey
2. Đăng nhập bằng tài khoản Google
3. Click "Create API Key"
4. Sao chép API key được tạo

## Bước 2: Cấu hình API Key

Mở file `/api/ai_summary.php` và thay đổi dòng:

```php
define('GEMINI_API_KEY', 'YOUR_GEMINI_API_KEY_HERE');
```

Thành:

```php
define('GEMINI_API_KEY', 'your-actual-api-key-here');
```

## Bước 3: Kiểm tra

1. Mở trang chi tiết sản phẩm: `http://localhost/Du-an-thuc-tap/?act=view-product-details&id=1`
2. Cuộn xuống phần "Tóm tắt sản phẩm bằng AI"
3. Nhấn nút "🤖 Tạo tóm tắt AI"
4. Chờ AI xử lý và hiển thị kết quả

## Chức năng

- ✅ Tóm tắt thông tin sản phẩm bằng AI
- ✅ Hiển thị màu sắc và kích thước có sẵn
- ✅ Giao diện đẹp với gradient và hiệu ứng
- ✅ Sao chép tóm tắt vào clipboard
- ✅ Responsive trên mobile
- ✅ Loading animation
- ✅ Error handling

## Lưu ý

- API Gemini có giới hạn rate limit, tránh spam request
- Đảm bảo server có thể truy cập internet để gọi API
- API key cần được bảo mật, không public lên git
