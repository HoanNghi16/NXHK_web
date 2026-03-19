<?php
session_start();
require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/services/product/productService.php";
require_once __DIR__ . "/layout/layout.php"; 

$layout = new Layout();
$productService = new ProductService($GLOBALS['conn']);

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);
    $quantity = 1;

    $result = $productService->getProductById($id);
    $product = $result['product'] ?? null;

    if (!$product) {
        die("Sản phẩm không tồn tại");
    }

} elseif (isset($_POST['product_id'])) {

    $id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity'] ?? 1);

    $result = $productService->getProductById($id);
    $product = $result['product'] ?? null;

    if (!$product) {
        die("Sản phẩm không tồn tại");
    }       

} else {
    die("Không có sản phẩm để thanh toán");
}

if (!$product) 
{ 
    die("Sản phẩm không tồn tại."); 
}

$images = $result['images'] ?? [];
$thumbnail = '';

foreach ($images as $img) {
    if ($img['is_thumbnail'] == 1) {
        $thumbnail = $img['path'];
        break;
    }
}

if (!$thumbnail && !empty($images)) {
    $thumbnail = $images[0]['path'];
}
$total = $product['price'] * $quantity;

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thanh toán - <?php echo $product['product_name']; ?></title>
    <link rel="stylesheet" href="../NXHK_web/style/checkout.css">
    <script src="../NXHK_web/js/checkout.js"></script>
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
                        <input type="number" id="display-qty" value="<?php echo $quantity; ?>" readonly
                            style="width: 40px; text-align: center; border:none;">
                        <button type="button" onclick="updateQty(1)">+</button>
                    </div>
                    <div class="summary-item" style="font-weight:bold; color:#d32f2f;">
                        <span>Tổng thanh toán:</span>
                        <span id="total-display">
                            <?php echo number_format($total, 0, ',', '.'); ?>đ
                        </span>
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
                    <input type="hidden" name="amount" id="form-amount" value="<?php echo $total; ?>">
                    <input type="hidden" name="quantity" id="form-qty" value="<?php echo $quantity; ?>">
                    <input type="hidden" id="unit-price" value="<?php echo (int)$product['price']; ?>">

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
                                <img src="<?php echo $thumbnail; ?>"
                                style="width: 100%; height: auto; object-fit: cover; border-radius: 6px;">
                            </td>
                            <td><?php echo $product['product_name']; ?></td>
                            <td><?php echo number_format($product['price'], 0, ',', '.'); ?>VNĐ</td>
                            <td id="table-qty" style="font-weight:bold; color:#d32f2f;"><?php echo $quantity; ?></td>
                            <td id="table-total" style="font-weight:bold; color:#d32f2f;">
                                <?php echo number_format($total, 0, ',', '.'); ?>VNĐ
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <?php echo $layout->getFooter(); ?>
</body>

</html>