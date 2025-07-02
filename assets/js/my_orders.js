function showTab(event, tabId) {
        // Tìm tất cả các phần tử tab-content và tab-link
        const tabs = document.querySelectorAll('.tab-content');
        const links = document.querySelectorAll('.tab-link');

        // Ẩn tất cả các nội dung tab và xóa class 'active' trên các nút
        tabs.forEach(tab => {
            tab.classList.remove('active');
        });
        links.forEach(link => {
            link.classList.remove('active');
        });

        // Hiển thị tab được chọn và gắn class 'active' vào nút
        const selectedTab = document.getElementById(tabId);
        if (selectedTab) {
            selectedTab.classList.add('active');
        }
        event.target.classList.add('active');
    }

    // Đảm bảo mặc định tab đầu tiên hiển thị
    document.addEventListener('DOMContentLoaded', () => {
        const firstTab = document.querySelector('.tab-content');
        const firstLink = document.querySelector('.tab-link');
        if (firstTab) {
            firstTab.classList.add('active');
        }
        if (firstLink) {
            firstLink.classList.add('active');
        }
    });

    function cancelOrder(orderId) {
    if (confirm("Bạn có chắc chắn muốn huỷ đơn hàng này?")) {
        fetch('http://localhost/Duan1/Project1_Team4/index.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ order_id: orderId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Đơn hàng đã được huỷ.");
                location.reload(); // Reload lại trang để cập nhật trạng thái đơn hàng
            } else {
                alert("Có lỗi xảy ra. Vui lòng thử lại.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Có lỗi xảy ra. Vui lòng thử lại.");
        });
    }
}

 document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-detail').forEach(button => {
            button.addEventListener('click', async (e) => {
                const orderId = button.dataset.orderId; // Lấy order_id từ data attribute
                if (!orderId) {
                    alert('Không tìm thấy mã đơn hàng!');
                    return;
                }

                try {
                    const response = await fetch(`./?act=get-order-details&order_id=${orderId}`);
                    const data = await response.json();

                    if (data.error) {
                        alert(data.error);
                    } else {
                        // Hiển thị chi tiết đơn hàng trong modal
                        const modalContent = document.querySelector('#modal-content');
                        modalContent.innerHTML = `
                            <h2>Order Details</h2>
                            <p>Order ID: P${data.order_id}</p>
                            <p>Order Date: ${data.order_date}</p>
                            <p>Address: ${data.dia_chi}</p>
                            <p>Phone Number: ${data.sdt}</p>
                            <p>Total Amount: ${data.total_amount} VND</p>
                            <p>Payment Method: ${data.pttt}</p>
                            <p>Status: ${data.status}</p>
                            <h3>Products</h3>
                            <ul>
                                ${data.products.map(product => `
                                    <li>${product.product_name} - Quantity: ${product.quantity}</li>
                                `).join('')}
                            </ul>
                        `;
                        document.querySelector('#modal').style.display = 'block';

                    }
                } catch (error) {
                    console.error(error);
                    alert('Có lỗi xảy ra khi tải chi tiết đơn hàng.');
                }
            });
        });
    });

    


    



