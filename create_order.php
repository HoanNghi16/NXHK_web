<?php
require_once __DIR__ . "/config/database.php";

$product_name = $_POST['order_desc'];
$amount = floatval($_POST['amount']);
$quantity = intval($_POST['quantity']);

$order_code = "ORD" . time() . rand(100,999);

$status = 1;

$stmt = $GLOBALS['conn']->prepare("
    INSERT INTO orders 
    (order_code, product_name, amount, quantity,
     customer_name, customer_email, customer_phone, customer_address, order_note,
     status, payment_method, created_at)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 'cod', NOW())
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
if (!$stmt->execute()) {
    die("Lỗi SQL: " . $stmt->error);
}
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request");
}

header("Location: order_status.php?order_id=" . $order_code . "&method=cod");
exit;