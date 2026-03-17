<?php
require_once __DIR__ . "/config/database.php";

$product_name = $_POST['order_desc'];
$amount = $_POST['amount'];
$quantity = $_POST['quantity'];

$order_code = "ORD" . time();

$status = 1;

$stmt = $GLOBALS['conn']->prepare("
    INSERT INTO orders (order_code, product_name, amount, quantity, status)
    VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param("ssdii", $order_code, $product_name, $amount, $quantity, $status);
$stmt->execute();

header("Location: order_status.php?order_id=" . $order_code . "&method=cod");
exit;