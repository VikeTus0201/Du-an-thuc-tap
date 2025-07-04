<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Cấu hình API Gemini
define('GEMINI_API_KEY', 'AIzaSyB9WwN9p12lYP7ykqWubBCqjJ44tCCE2dI'); // Thay thế bằng API key của bạn
define('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent');

function callGeminiAPI($prompt) {
    $url = GEMINI_API_URL . '?key=' . GEMINI_API_KEY;
    
    $data = [
        'contents' => [
            [
                'parts' => [
                    ['text' => $prompt]
                ]
            ]
        ]
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data)
        ],
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    if ($result === FALSE) {
        // Thử sử dụng cURL thay thế
        return callGeminiAPICurl($url, $data);
    }
    
    return json_decode($result, true);
}

function callGeminiAPICurl($url, $data) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if (curl_error($ch)) {
        curl_close($ch);
        return false;
    }
    
    curl_close($ch);
    
    if ($httpCode !== 200) {
        return false;
    }
    
    return json_decode($result, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['product_name']) || !isset($input['description']) || !isset($input['price'])) {
        echo json_encode(['error' => 'Thiếu thông tin sản phẩm']);
        exit;
    }
    
    $productName = $input['product_name'];
    $description = $input['description'];
    $price = $input['price'];
    $colors = isset($input['colors']) ? $input['colors'] : [];
    $sizes = isset($input['sizes']) ? $input['sizes'] : [];
    
    // Tạo prompt cho AI
    $prompt = "
Hãy tóm tắt thông tin sản phẩm giày sau đây một cách ngắn gọn và hấp dẫn trong khoảng 100-150 từ:

Tên sản phẩm: {$productName}
Giá: " . number_format($price, 0, ',', '.') . " VND
Mô tả: {$description}
Màu sắc có sẵn: " . implode(', ', $colors) . "
Kích thước có sẵn: " . implode(', ', $sizes) . "

Yêu cầu:
1. Tóm tắt ngắn gọn, súc tích
2. Nhấn mạnh điểm nổi bật của sản phẩm
3. Phù hợp cho việc giới thiệu sản phẩm trên website bán hàng
4. Sử dụng ngôn ngữ tiếng Việt
5. Tập trung vào chất lượng, thiết kế và tính ứng dụng của giày
";

    $response = callGeminiAPI($prompt);
    
    if ($response && isset($response['candidates'][0]['content']['parts'][0]['text'])) {
        $summary = $response['candidates'][0]['content']['parts'][0]['text'];
        echo json_encode([
            'success' => true,
            'summary' => trim($summary)
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Không thể tạo tóm tắt. Vui lòng thử lại.',
            'debug' => $response
        ]);
    }
} else {
    echo json_encode(['error' => 'Chỉ chấp nhận POST request']);
}
?>
