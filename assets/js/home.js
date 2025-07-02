const slideshow = document.querySelector('.slideshow');
const slides = document.querySelectorAll('.slideshow img');
let currentIndex = 0;

// Nhân đôi slide để tạo vòng lặp vô cực
slideshow.appendChild(slides[0].cloneNode(true));

function nextSlide() {
    currentIndex++;
    slideshow.style.transform = `translateX(-${currentIndex * 100}%)`;

    // Nếu đến cuối, reset về đầu
    if (currentIndex === slides.length) {
        setTimeout(() => {
            slideshow.style.transition = 'none'; // Tắt chuyển động
            currentIndex = 0;
            slideshow.style.transform = 'translateX(0)';
            setTimeout(() => {
                slideshow.style.transition = 'transform 0.5s ease'; // Bật lại chuyển động
            }, 50);
        }, 500); // Đợi animation hoàn tất
    }
}

// Chạy slide tự động
setInterval(nextSlide, 3000); // 3 giây chuyển slide
