<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../layout/layout.php";
require_once __DIR__ . "/config.php";

$layout = new Layout();

$vnp_SecureHash = $_GET['vnp_SecureHash'] ?? '';

$inputData = array();
foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

unset($inputData['vnp_SecureHash']);
ksort($inputData);

$hashData = "";
$i = 0;
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashData .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
}

$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
$isSuccess = ($secureHash == $vnp_SecureHash && ($_GET['vnp_ResponseCode'] ?? '') == '00');

$order_code = $_GET['vnp_TxnRef'] ?? '';
$amount = isset($_GET['vnp_Amount']) ? $_GET['vnp_Amount'] / 100 : 0;
$orderInfo = $_GET['vnp_OrderInfo'] ?? '';
$responseCode = $_GET['vnp_ResponseCode'] ?? '';
$transactionNo = $_GET['vnp_TransactionNo'] ?? '';
$bankCode = $_GET['vnp_BankCode'] ?? '';
$payDateRaw = $_GET['vnp_PayDate'] ?? '';

$formattedDate = "";
if ($payDateRaw) {
    $formattedDate = date("d/m/Y H:i:s", strtotime($payDateRaw));
}

if ($isSuccess) {
    $order_code = $_GET['vnp_TxnRef'];
    $amount = $_GET['vnp_Amount'] / 100;

    $sql = "UPDATE orders 
            SET status = 2, 
                amount = ?, 
                payment_method = 'vnpay' 
            WHERE order_code = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ds", $amount, $order_code);
    $stmt->execute();

    header("Location: ../order_status.php?order_id=$order_code&method=vnpay");
    exit;
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Kết quả thanh toán VNPay</title>

    <link href="assets/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php echo $layout->getHeader(); ?>

    <div class="container" style="margin-top: 50px;">
        <h3>KẾT QUẢ THANH TOÁN VNPAY</h3>

        <div class="form-group">
            <strong>Mã đơn hàng:</strong> <?php echo htmlspecialchars($order_code); ?>
        </div>

        <div class="form-group">
            <strong>Số tiền:</strong> <?php echo number_format($amount, 0, ',', '.'); ?> VNĐ
        </div>

        <div class="form-group">
            <strong>Nội dung:</strong> <?php echo htmlspecialchars($orderInfo); ?>
        </div>

        <div class="form-group">
            <strong>Mã phản hồi:</strong> <?php echo $responseCode; ?>
        </div>

        <div class="form-group">
            <strong>Mã giao dịch:</strong> <?php echo $transactionNo; ?>
        </div>

        <div class="form-group">
            <strong>Ngân hàng:</strong> <?php echo $bankCode; ?>
        </div>

        <div class="form-group">
            <strong>Thời gian:</strong> <?php echo $formattedDate; ?>
        </div>

        <div class="form-group">
            <strong>Kết quả:</strong>
            <?php if ($isSuccess): ?>
            <span style="color:green; font-weight:bold;">Thanh toán thành công</span>
            <?php else: ?>
            <span style="color:red; font-weight:bold;">Thanh toán thất bại</span>
            <?php endif; ?>
        </div>

        <div style="margin-top: 30px; margin-bottom: 50px; text-align: center;">
            <a href="../home.php" style="text-decoration: none; color: #007bff; font-weight: bold;">
                Tiếp tục mua sắm
            </a>
        </div>
    </div>

    <script>
    <?php if ($isSuccess): ?>
    setTimeout(function() {
        window.location.href = "../order_status.php?order_id=<?php echo $order_code; ?>&method=vnpay";
    }, 3000);
    <?php endif; ?>
    </script>

    <?php echo $layout->getFooter(); ?>

</body>

</html>