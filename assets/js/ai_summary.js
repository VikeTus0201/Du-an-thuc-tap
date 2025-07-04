class AISummary {
    constructor() {
        this.apiUrl = './api/ai_summary.php';
        this.isLoading = false;
        this.init();
    }

    init() {
        this.bindEvents();
    }

    bindEvents() {
        const generateBtn = document.getElementById('ai-generate-btn');
        const copyBtn = document.getElementById('copy-summary-btn');

        if (generateBtn) {
            generateBtn.addEventListener('click', () => this.generateSummary());
        }

        if (copyBtn) {
            copyBtn.addEventListener('click', () => this.copySummary());
        }
    }

    async generateSummary() {
        if (this.isLoading) return;

        this.isLoading = true;
        this.showLoading();
        this.hideError();

        try {
            // Lấy thông tin sản phẩm từ trang
            const productData = this.getProductData();
            
            const response = await fetch(this.apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(productData)
            });

            const data = await response.json();

            if (data.success) {
                this.displaySummary(data.summary);
            } else {
                this.showError(data.error || 'Có lỗi xảy ra khi tạo tóm tắt');
            }
        } catch (error) {
            console.error('Error:', error);
            this.showError('Không thể kết nối tới dịch vụ AI. Vui lòng thử lại.');
        } finally {
            this.isLoading = false;
            this.hideLoading();
        }
    }

    getProductData() {
        // Lấy thông tin sản phẩm từ các element trên trang
        const productName = document.querySelector('.product-details h1')?.textContent?.trim() || '';
        const description = document.querySelector('.product-image p')?.textContent?.trim() || '';
        const priceElement = document.querySelector('.price');
        const price = priceElement ? this.extractPrice(priceElement.textContent) : 0;

        // Lấy màu sắc có sẵn
        const colors = [];
        const colorElements = document.querySelectorAll('.color-swatch');
        colorElements.forEach(element => {
            const style = element.getAttribute('style');
            if (style && style.includes('background-color')) {
                const color = style.match(/background-color:\s*([^;]+)/);
                if (color) colors.push(color[1].trim());
            }
        });

        // Lấy kích thước có sẵn
        const sizes = [];
        const sizeElements = document.querySelectorAll('.size-button');
        sizeElements.forEach(element => {
            sizes.push(element.textContent.trim());
        });

        return {
            product_name: productName,
            description: description,
            price: price,
            colors: [...new Set(colors)], // Loại bỏ trùng lặp
            sizes: [...new Set(sizes)]    // Loại bỏ trùng lặp
        };
    }

    extractPrice(priceText) {
        // Trích xuất số từ chuỗi giá (ví dụ: "1,200,000 VND" -> 1200000)
        const numbers = priceText.replace(/[^\d]/g, '');
        return parseInt(numbers) || 0;
    }

    displaySummary(summary) {
        const contentElement = document.getElementById('ai-summary-content');
        const placeholderElement = document.querySelector('.ai-summary-placeholder');
        const copyBtn = document.getElementById('copy-summary-btn');

        if (contentElement) {
            contentElement.textContent = summary;
            contentElement.style.display = 'block';
        }

        if (placeholderElement) {
            placeholderElement.style.display = 'none';
        }

        if (copyBtn) {
            copyBtn.style.display = 'inline-block';
        }
    }

    copySummary() {
        const contentElement = document.getElementById('ai-summary-content');
        if (contentElement) {
            const text = contentElement.textContent;
            
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(() => {
                    this.showCopySuccess();
                }).catch(() => {
                    this.fallbackCopy(text);
                });
            } else {
                this.fallbackCopy(text);
            }
        }
    }

    fallbackCopy(text) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        try {
            document.execCommand('copy');
            this.showCopySuccess();
        } catch (err) {
            console.error('Fallback copy failed:', err);
        }
        document.body.removeChild(textArea);
    }

    showCopySuccess() {
        const copyBtn = document.getElementById('copy-summary-btn');
        if (copyBtn) {
            const originalText = copyBtn.textContent;
            copyBtn.textContent = '✓ Đã sao chép';
            copyBtn.classList.add('success');
            
            setTimeout(() => {
                copyBtn.textContent = originalText;
                copyBtn.classList.remove('success');
            }, 2000);
        }
    }

    showLoading() {
        const loadingElement = document.getElementById('ai-loading');
        const generateBtn = document.getElementById('ai-generate-btn');
        
        if (loadingElement) {
            loadingElement.classList.add('active');
        }
        
        if (generateBtn) {
            generateBtn.disabled = true;
            generateBtn.textContent = 'Đang tạo...';
        }
    }

    hideLoading() {
        const loadingElement = document.getElementById('ai-loading');
        const generateBtn = document.getElementById('ai-generate-btn');
        
        if (loadingElement) {
            loadingElement.classList.remove('active');
        }
        
        if (generateBtn) {
            generateBtn.disabled = false;
            generateBtn.innerHTML = '🤖 Tạo tóm tắt';
        }
    }

    showError(message) {
        const errorElement = document.getElementById('ai-error');
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.add('active');
        }
    }

    hideError() {
        const errorElement = document.getElementById('ai-error');
        if (errorElement) {
            errorElement.classList.remove('active');
        }
    }
}

// Khởi tạo khi DOM đã load
document.addEventListener('DOMContentLoaded', () => {
    new AISummary();
});
