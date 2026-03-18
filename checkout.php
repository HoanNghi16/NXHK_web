<?php
session_start();
require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/services/product/productService.php";
require_once __DIR__ . "/layout/layout.php"; 

$layout = new Layout();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$productService = new ProductService($GLOBALS['conn']);
$result = $productService->getProductById($id);
$product = $result['product'] ?? null;

if (!$product) { die("Sản phẩm không tồn tại."); }
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thanh toán - <?php echo $product['product_name']; ?></title>
    <style>
    body {
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
        font-family: sans-serif;
    }

    .container {
        max-width: 1100px;
        margin: 30px auto;
        padding: 0 15px;
    }

    .checkout-main {
        display: flex;
        gap: 30px;
        margin-bottom: 30px;
    }

    .left-col {
        flex: 1.5;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .right-col {
        flex: 1;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #eee;
    }

    h2 {
        font-size: 20px;
        margin-top: 0;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .total-price {
        color: #d32f2f;
        font-size: 24px;
        font-weight: bold;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 15px 0;
    }

    .quantity-control button {
        width: 30px;
        height: 30px;
        cursor: pointer;
        border: 1px solid #ddd;
        background: #fff;
    }

    .btn-pay {
        width: 100%;
        background: #007bff;
        color: #fff;
        border: none;
        padding: 15px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        border-radius: 5px;
        margin-top: 20px;
    }

    .btn-pay:hover {
        background: #0056b3;
    }

    .order-details-table {
        width: 100%;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        box-sizing: border-box;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    table th {
        background: #f8f8f8;
        padding: 12px;
        text-align: left;
        border-bottom: 2px solid #eee;
    }

    table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }
    </style>
</head>

<body>

    <?php echo $layout->getHeader(); ?>

    <div class="container">
        <form id="checkoutForm" method="POST">
            <div class="checkout-main">
                <div class="left-col">
                    <h2>Thông tin nhận hàng</h2>
                    <div class="form-group">
                        <label>Họ và tên</label>
                        <input type="text" name="customer_name" required placeholder="Nguyễn Văn A" required>
                        <span style="color: red;">*</span>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="customer_email" required placeholder="name@gmail.com" required>
                        <span style="color: red;">*</span>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="tel" name="customer_phone" required placeholder="0901234567" required>
                        <span style="color: red;">*</span>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ nhận hàng</label>
                        <textarea name="customer_address" rows="2" required
                            placeholder="Số nhà, tên đường, phường/xã..."></textarea>
                        <span style="color: red;">*</span>
                    </div>
                    <div class="form-group">
                        <label>Ghi chú</label>
                        <textarea name="order_note" rows="4" placeholder="Lưu ý cho shipper..."></textarea>
                    </div>
                </div>

                <div class="right-col">
                    <h2>Đơn hàng</h2>
                    <div class="summary-item">
                        <span>Sản phẩm:</span>
                        <strong><?php echo $product['product_name']; ?></strong>
                    </div>
                    <div class="quantity-control">
                        <span>Số lượng:</span>
                        <button type="button" onclick="updateQty(-1)">-</button>
                        <input type="number" id="display-qty" value="1" readonly
                            style="width: 40px; text-align: center; border:none;">
                        <button type="button" onclick="updateQty(1)">+</button>
                    </div>
                    <div class="summary-item" style="border-top: 1px dashed #ccc; padding-top: 15px;">
                        <span>Tổng thanh toán:</span>
                        <span class="total-price"
                            id="total-display"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</span>
                    </div>

                    <div style="margin-top: 20px;">
                        <label>
                            <input type="radio" name="payment_choice" value="cod" checked> Thanh toán khi nhận hàng
                        </label><br><br>
                        <label>
                            <input type="radio" name="payment_choice" value="vnpay"> Thanh toán qua VNPay
                        </label>
                    </div>

                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <input type="hidden" name="order_desc" value="<?php echo $product['product_name']; ?>">
                    <input type="hidden" name="amount" id="form-amount" value="<?php echo $product['price']; ?>">
                    <input type="hidden" name="quantity" id="form-qty" value="1">

                    <button type="submit" id="submitBtn" class="btn-pay">ĐẶT HÀNG</button>
                </div>
            </div>

            <div class="order-details-table">
                <h2>Chi tiết đơn hàng</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá tiền</th>
                            <th>Số lượng</th>
                            <th>Tổng cộng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 120px;">
                                <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8"
                                    style="width: 100%; height: auto; object-fit: cover; border-radius: 6px;">
                            </td>
                            <td><?php echo $product['product_name']; ?></td>
                            <td><?php echo number_format($product['price'], 0, ',', '.'); ?>VNĐ</td>
                            <td id="table-qty">1</td>
                            <td id="table-total" style="font-weight:bold; color:#d32f2f;">
                                <?php echo number_format($product['price'], 0, ',', '.'); ?>VNĐ
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {

        const unitPrice = <?php echo $product['price']; ?>;

        window.updateQty = function(change) {
            let qty = parseInt(document.getElementById('display-qty').value) + change;
            if (qty < 1) qty = 1;

            const total = qty * unitPrice;
            const totalFormatted = total.toLocaleString('vi-VN') + 'đ';

            document.getElementById('display-qty').value = qty;
            document.getElementById('total-display').innerText = totalFormatted;

            const tableQty = document.getElementById('table-qty');
            const tableTotal = document.getElementById('table-total');
            if (tableQty) tableQty.innerText = qty;
            if (tableTotal) tableTotal.innerText = totalFormatted;

            document.getElementById('form-qty').value = qty;
            document.getElementById('form-amount').value = total;
        }

        const nameInput = document.querySelector('[name="customer_name"]');
        const emailInput = document.querySelector('[name="customer_email"]');
        const phoneInput = document.querySelector('[name="customer_phone"]');
        const addressInput = document.querySelector('[name="customer_address"]');
        const btn = document.getElementById('submitBtn');
        const form = document.getElementById('checkoutForm');

        function checkForm() {
            if (
                nameInput.value.trim() &&
                emailInput.value.trim() &&
                phoneInput.value.trim() &&
                addressInput.value.trim()
            ) {
                btn.disabled = false;
                btn.style.opacity = "1";
            } else {
                btn.disabled = true;
                btn.style.opacity = "0.5";
            }
        }

        [nameInput, emailInput, phoneInput, addressInput].forEach(input => {
            input.addEventListener("input", checkForm);
        });

        form.addEventListener("submit", function(e) {
            if (!form.checkValidity()) {
                form.reportValidity();
                e.preventDefault();
                return;
            }

            const method = document.querySelector('input[name="payment_choice"]:checked').value;

            if (method === 'cod') {
                form.action = "create_order.php";
            } else {
                form.action = "vnpay_php/vnpay_create_payment.php";
            }
        });

    });
    </script>

    <?php echo $layout->getFooter(); ?>
</body>

</html>