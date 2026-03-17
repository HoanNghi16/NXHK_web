<?php
session_start();
include_once "../../config/database.php"; 

if (isset($_GET['action']) && $_GET['action'] == 'create') {
    $fullname = $_POST['fullname'];
    $payment_method = $_POST['payment'];

    unset($_SESSION['cart']);
    header("Location: ../../order_tracking.php?status=success&method=" . $payment_method);
    exit();
}
?>
