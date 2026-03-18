<?php
require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/layout/layout.php";

$layout = new Layout();

$order_id = $_GET['order_id'] ?? ($_GET['vnp_TxnRef'] ?? null);
date_default_timezone_set('Asia/Ho_Chi_Minh');

$order = null;

if ($order_id) {
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_code = ?");
    $stmt->bind_param("s", $order_id);
    $stmt->execute();
    $order = $stmt->get_result()->fetch_assoc();
}

if (!$order) {
    die("Đơn hàng không tồn tại!");
} 

$status = $order['status'];

$paymentText = "Không xác định";
$paymentText = ($order['payment_method'] === 'cod')
    ? "Thanh toán khi nhận hàng"
    : "VNPay (ATM/Visa/QR)";

$successText = ($order['payment_method'] === 'cod') 
    ? "Đặt hàng thành công" 
    : "Thanh toán thành công";

$vnp_ResponseCode = $_GET['vnp_ResponseCode'] ?? null;

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tiến độ đơn hàng - <?php echo htmlspecialchars($order_id); ?></title>
    <link rel="stylesheet" href="../NXHK_web/style/order_status.css">
</head>

<body>

    <?php echo $layout->getHeader(); ?>

    <div class="status-container">

        <span class="success-badge"><?php echo $successText; ?></span>

        <h2>Mã đơn hàng: #<?php echo htmlspecialchars($order_id); ?></h2>

        <div class="timeline">
            <div class="step <?php echo ($status >= 1) ? 'active' : ''; ?>">
                <div class="circle"></div>
                <div class="label">Đã xác nhận</div>
            </div>

            <div class="step <?php echo ($status >= 2) ? 'active' : ''; ?>">
                <div class="circle"></div>
                <div class="label">Đang chuẩn bị hàng</div>
            </div>

            <div class="step <?php echo ($status >= 3) ? 'active' : ''; ?>">
                <div class="circle"></div>
                <div class="label">Đang giao hàng</div>
            </div>

            <div class="step <?php echo ($status >= 4) ? 'active' : ''; ?>">
                <div class="circle"></div>
                <div class="label">Giao hàng thành công</div>
            </div>
        </div>

        <div class="order-info">
            <p><strong>Ngày đặt:</strong> <?php echo date("d/m/Y H:i", strtotime($order['created_at'])); ?></p>
            <p><strong>Người nhận:</strong>
                <?php echo htmlspecialchars($order['customer_name'] ?? 'Không có dữ liệu'); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($order['customer_email'] ?? 'Không có dữ liệu'); ?>
            </p>
            <p><strong>Số điện thoại:</strong>
                <?php echo htmlspecialchars($order['customer_phone'] ?? 'Không có dữ liệu'); ?></p>
            <p><strong>Địa chỉ:</strong>
                <?php echo htmlspecialchars($order['customer_address'] ?? 'Không có dữ liệu'); ?></p>
            <p><strong>Ghi chú:</strong> <?php echo htmlspecialchars($order['order_note'] ?? 'Không có dữ liệu'); ?></p>
            <p><strong>Phương thức thanh toán:</strong> <?php echo $paymentText; ?></p>
            <p><strong>Tên sản phẩm:</strong>
                <?php echo htmlspecialchars($order['product_name'] ?? 'Không có dữ liệu'); ?>
            </p>
            <p><strong>Số lượng:</strong> <?php echo $order['quantity']; ?></p>
            <p><strong>Tổng tiền:</strong>
                <?php echo isset($order['amount']) ? number_format($order['amount'], 0, ',', '.') : '0'; ?> VNĐ
            </p>
            <p><strong>Dự kiến nhận hàng:</strong> 2 - 3 ngày tới</p>
        </div>

        <div style="margin-top: 30px; text-align: center;">
            <a href="home.php" style="text-decoration: none; color: #007bff; font-weight: bold;">
                Tiếp tục mua sắm
            </a>
        </div>

    </div>

    <?php echo $layout->getFooter(); ?>

</body>

</html>