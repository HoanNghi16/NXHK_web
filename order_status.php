<?php
require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/layout/layout.php";

$layout = new Layout();
// Lấy mã đơn hàng từ URL (sau khi thanh toán xong VNPAY sẽ trả về vnp_TxnRef)
$order_id = $_GET['order_id'] ?? ($_GET['vnp_TxnRef'] ?? null);

// Giả sử bạn có bảng 'orders' trong DB với cột 'status' (0: Chờ thanh toán, 1: Đã thanh toán, 2: Đang giao, 3: Thành công)
$order = null;
if ($order_id) {
    $stmt = $GLOBALS['conn']->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param("s", $order_id);
    $stmt->execute();
    $order = $stmt->get_result()->fetch_assoc();
}

// Mặc định nếu chưa có DB, ta giả lập status để bạn xem giao diện
$status = $order['status'] ?? 1; 
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tiến độ đơn hàng - <?php echo $order_id; ?></title>
    <style>
        body { font-family: 'Segoe UI', Arial; background: #f4f7f6; margin: 0; }
        .status-container { max-width: 800px; margin: 120px auto; background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        
        /* CSS cho Timeline tiến độ */
        .timeline { display: flex; justify-content: space-between; position: relative; margin-top: 50px; }
        .timeline::before { content: ''; position: absolute; top: 15px; left: 0; width: 100%; height: 4px; background: #e0e0e0; z-index: 1; }
        .step { position: relative; z-index: 2; text-align: center; width: 25%; }
        .circle { width: 34px; height: 34px; background: #fff; border: 4px solid #e0e0e0; border-radius: 50%; margin: 0 auto 10px; transition: 0.3s; }
        .step.active .circle { border-color: #007bff; background: #007bff; }
        .step.active .label { color: #007bff; font-weight: bold; }
        .label { font-size: 14px; color: #888; }

        .order-info { margin-top: 40px; padding: 20px; border: 1px solid #eee; border-radius: 8px; background: #fafafa; }
        .success-badge { color: #28a745; font-weight: bold; font-size: 20px; display: block; margin-bottom: 20px; }
    </style>
</head>
<body>

<?php echo $layout->getHeader(); ?>

<div class="status-container">
    <span class="success-badge">✓ Thanh toán thành công!</span>
    <h2>Mã đơn hàng: #<?php echo $order_id; ?></h2>
    
    <div class="timeline">
        <!-- Bước 1: Đặt hàng -->
        <div class="step <?php echo ($status >= 1) ? 'active' : ''; ?>">
            <div class="circle"></div>
            <div class="label">Đã thanh toán</div>
        </div>
        <!-- Bước 2: Xác nhận -->
        <div class="step <?php echo ($status >= 2) ? 'active' : ''; ?>">
            <div class="circle"></div>
            <div class="label">Đang đóng gói</div>
        </div>
        <!-- Bước 3: Vận chuyển -->
        <div class="step <?php echo ($status >= 3) ? 'active' : ''; ?>">
            <div class="circle"></div>
            <div class="label">Đang giao hàng</div>
        </div>
        <!-- Bước 4: Hoàn thành -->
        <div class="step <?php echo ($status >= 4) ? 'active' : ''; ?>">
            <div class="circle"></div>
            <div class="label">Thành công</div>
        </div>
    </div>

    <div class="order-info">
        <p><strong>Ngày đặt:</strong> <?php echo date("d/m/Y H:i"); ?></p>
        <p><strong>Phương thức:</strong> VNPay (ATM/Visa/QR)</p>
        <p><strong>Dự kiến nhận hàng:</strong> 2 - 3 ngày tới</p>
    </div>

    <div style="margin-top: 30px; text-align: center;">
        <a href="home.php" style="text-decoration: none; color: #007bff; font-weight: bold;">← Tiếp tục mua sắm</a>
    </div>
</div>

<?php echo $layout->getFooter(); ?>

</body>
</html>
