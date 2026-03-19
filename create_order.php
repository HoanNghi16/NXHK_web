<?php
require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/services/mail/mailService.php";

$conn = $GLOBALS['conn'];

$product_name = $_POST['order_desc'];
$amount = floatval($_POST['amount']);
$quantity = intval($_POST['quantity']);

$order_code = "ORD" . time() . rand(100,999);

$status = 1;

$stmt = $GLOBALS['conn']->prepare("
    INSERT INTO orders 
    (order_code, product_name, amount, quantity,
     customer_name, customer_email, customer_phone, customer_address, order_note,
     status, payment_method, created_at, is_emailed)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 'cod', NOW(), 0)
");

$customer_name = $_POST['customer_name'];
$customer_email = $_POST['customer_email'];
$customer_phone = $_POST['customer_phone'];
$customer_address = $_POST['customer_address'];
$order_note = $_POST['order_note'] ?? '';

$stmt->bind_param(
    "ssdisssss",
    $order_code,
    $product_name,
    $amount,
    $quantity,
    $customer_name,
    $customer_email,
    $customer_phone,
    $customer_address,
    $order_note
);

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request");
}

if (!$stmt->execute()) {
    die("Lỗi SQL: " . $stmt->error);
}

$stmt2 = $conn->prepare("SELECT * FROM orders WHERE order_code = ?");
$stmt2->bind_param("s", $order_code);
$stmt2->execute();
$order = $stmt2->get_result()->fetch_assoc();

$mailService = new MailService();

if ($order && $order['is_emailed'] == 0) {
    if ($mailService->sendOrderMail($order)) {
        $update = $conn->prepare("UPDATE orders SET is_emailed = 1 WHERE order_code = ?");
        $update->bind_param("s", $order_code);
        $update->execute();
    }
}

header("Location: order_status.php?order_id=" . $order_code . "&method=cod");
exit;