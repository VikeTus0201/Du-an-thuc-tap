// Lấy phần tử icon và input
const searchIcon = document.getElementById('search-icon');
const searchInput = document.getElementById('search-input');

// Thêm sự kiện click vào search icon
searchIcon.addEventListener('click', () => {
    if (searchInput.style.display === 'none' || searchInput.style.display === '') {
        searchInput.style.display = 'block';
        searchInput.focus(); // Đặt focus vào input
    } else {
        if (searchInput.value.trim() === '') {
            searchInput.style.display = 'none';
        }
    }
});

// Xử lý sự kiện nhấn Enter trong input
searchInput.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
        event.preventDefault(); // Ngăn hành vi mặc định
        if (this.form) {
            this.form.submit(); // Gửi form
        } else {
            console.error("Input không nằm trong form hợp lệ.");
        }
    }
});
