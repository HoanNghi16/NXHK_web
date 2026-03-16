<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

/**
 * Xử lý tạo thanh toán VNPAY
 */
require_once("./config.php");

// 1. Nhận dữ liệu từ form checkout.php gửi sang
$vnp_TxnRef = date("YmdHis"); // Mã đơn hàng sử dụng thời gian để không bị trùng
$vnp_Amount = $_POST['amount']; // Số tiền từ input name="amount"
$vnp_Locale = 'vn'; // Mặc định tiếng Việt
$vnp_BankCode = ""; // Để trống để khách tự chọn ngân hàng trên VNPAY
$vnp_IpAddr = $_SERVER['REMOTE_ADDR']; 

// 2. Cấu hình thời gian hết hạn (ví dụ 15 phút)
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount * 100, // VNPAY yêu cầu nhân 100
    "vnp_Command" => "pay",
    "vnp_CreateDate" => $startTime,
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => "Thanh toan don hang: " . $vnp_TxnRef, // Dùng dấu chấm để nối chuỗi trong PHP
    "vnp_OrderType" => "other",
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_ExpireDate" => $expire
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}

// 3. Sắp xếp dữ liệu theo alphabet (Yêu cầu của VNPAY)
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

// 4. Tạo URL và mã băm bảo mật
$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}

// 5. Chuyển hướng khách sang trang thanh toán VNPAY
header('Location: ' . $vnp_Url);
die();
