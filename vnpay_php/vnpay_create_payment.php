<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Phương thức không hợp lệ");
}

$product_id     = (int)($_POST['product_id'] ?? 0);
$quantity       = max(1, (int)($_POST['quantity'] ?? 1));
$customer_name  = trim($_POST['customer_name'] ?? '');
$customer_email = trim($_POST['customer_email'] ?? '');
$customer_phone = trim($_POST['customer_phone'] ?? '');
$customer_address = trim($_POST['customer_address'] ?? '');
$order_note     = trim($_POST['order_note'] ?? '');

if ($product_id <= 0) {
    die("Thiếu thông tin sản phẩm");
}

require_once __DIR__ . '/../services/product/productService.php';
$productService = new ProductService($GLOBALS['conn']);
$product = $productService->getProductById($product_id);

if (!$product) {
    die("Sản phẩm không tồn tại");
}

$product_name = $product['product']['product_name'];
$price = (int)$product['product']['price'];
$real_amount = $price * $quantity;

$order_code = 'ORD' . date('YmdHis') . mt_rand(1000, 9999);

$stmt = $conn->prepare("
    INSERT INTO orders (
        order_code, product_name, amount, quantity,
        customer_name, customer_email, customer_phone, customer_address, order_note,
        status, created_at, payment_method, is_emailed
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'vnpay', 0)
");
if (!$stmt){
    die ($conn->error);
}
$status = 1;
$stmt->bind_param(
    "ssissssssi",
    $order_code,
    $product_name,
    $real_amount,
    $quantity,
    $customer_name,
    $customer_email,
    $customer_phone,
    $customer_address,
    $order_note,
    $status
);

if (!$stmt->execute()) {
    error_log("Lỗi insert đơn VNPay: " . $stmt->error);
    die("Lỗi hệ thống khi tạo đơn hàng. Vui lòng thử lại sau.");
}

$vnp_TxnRef = $order_code;

$vnp_Amount = $real_amount;

$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount * 100,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => $startTime,
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
    "vnp_Locale" => 'vn',
    "vnp_OrderInfo" => "Thanh toán đơn hàng: " . $vnp_TxnRef . " - " . $product_name,
    "vnp_OrderType" => "billpayment",
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_ExpireDate" => $expire
);

ksort($inputData);

$hashdata = "";
$query = "";
$i = 0;

foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$query = rtrim($query, '&');

$vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

$vnp_Url = $vnp_Url . "?" . $query . '&vnp_SecureHash=' . $vnpSecureHash;;

header('Location: ' . $vnp_Url);
exit;