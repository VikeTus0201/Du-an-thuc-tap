  
        

        // Lưu trữ lựa chọn hiện tại của người dùng
        let selectedColor = null;
        let selectedSize = null;

        // Cập nhật thông tin stock khi chọn màu sắc hoặc kích thước
        function updateStock(value, type) {
            if (type === 'color') {
                selectedColor = value;
            } else if (type === 'size') {
                selectedSize = value;
            }

            // Tìm kiếm trong dữ liệu để hiển thị số lượng tồn kho tương ứng
            const stockList = document.getElementById('stock-list');
            stockList.innerHTML = ''; // Xóa danh sách cũ

            let foundStock = false; // Biến kiểm tra xem có tìm thấy dữ liệu tồn kho hay không

            productDetails.forEach(detail => {
                if ((selectedColor === null || detail.ma_mau_hex === selectedColor) &&
                    (selectedSize === null || detail.so_size === selectedSize)) {

                    const stockItem = document.createElement('li');
                    stockItem.textContent = `Số lượng: ${detail.so_luong}`;
                    stockList.appendChild(stockItem);
                    foundStock = true; // Đã tìm thấy kết quả, cập nhật flag 
                }
            });

            // Nếu không tìm thấy dữ liệu tồn kho, hiển thị số lượng là 0
            if (!foundStock) {
                const stockItem = document.createElement('li');
                stockItem.textContent = 'Số lượng: 0';
                stockList.appendChild(stockItem);
            }
        }
