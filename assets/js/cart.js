document.querySelectorAll('input[name="quantity"]').forEach(input => {
        input.addEventListener('input', function() {
            // Lấy giá trị tối đa từ thuộc tính max
            const maxQuantity = parseInt(this.getAttribute('max'), 10);
            const minQuantity = 1;
            let currentValue = parseInt(this.value, 10);

            // Kiểm tra nếu giá trị không hợp lệ hoặc vượt quá giới hạn
            if (isNaN(currentValue) || currentValue < minQuantity) {
                this.value = minQuantity; // Gán giá trị tối thiểu
            } else if (currentValue > maxQuantity) {
                this.value = maxQuantity; // Gán giá trị tối đa
            }
        });

        // Kiểm tra lại khi rời khỏi ô input
        input.addEventListener('blur', function() {
            const maxQuantity = parseInt(this.getAttribute('max'), 10);
            const minQuantity = 1;
            let currentValue = parseInt(this.value, 10);

            if (isNaN(currentValue) || currentValue < minQuantity) {
                alert('Số lượng không được nhỏ hơn 1!');
                this.value = minQuantity;
            } else if (currentValue > maxQuantity) {
                alert(`Số lượng không được vượt quá tồn kho: ${maxQuantity}`);
                this.value = maxQuantity;
            }
        });
    });

    document.querySelectorAll('.quantity-control').forEach(control => {
        const input = control.querySelector('input[name="quantity"]');
        const decrementBtn = control.querySelector('.decrement');
        const incrementBtn = control.querySelector('.increment');

        // Xử lý khi nhấn nút trừ
        decrementBtn.addEventListener('click', () => {
            let currentValue = parseInt(input.value, 10) || 1;
            const minValue = parseInt(input.min, 10) || 1;
            if (currentValue > minValue) {
                input.value = currentValue - 1;
                input.form.submit(); // Gửi form
            }
        });

        // Xử lý khi nhấn nút cộng
        incrementBtn.addEventListener('click', () => {
            let currentValue = parseInt(input.value, 10) || 1;
            const maxValue = parseInt(input.max, 10);
            if (currentValue < maxValue) {
                input.value = currentValue + 1;
                input.form.submit(); // Gửi form
            }
        });

        // Cập nhật trạng thái nút khi giá trị thay đổi
        input.addEventListener('input', () => {
            let currentValue = parseInt(input.value, 10) || 1;
            const minValue = parseInt(input.min, 10) || 1;
            const maxValue = parseInt(input.max, 10);

            decrementBtn.disabled = currentValue <= minValue;
            incrementBtn.disabled = currentValue >= maxValue;
        });
    });