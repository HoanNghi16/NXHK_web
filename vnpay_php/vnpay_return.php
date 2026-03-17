<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>VNPAY RESPONSE</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/bootstrap.min.css" rel="stylesheet""")/>>
        <!-- Custom styles for this template -->
        <link href="assets/jumbotron-narrow.css" rel="stylesheet">         
        <script src="assets/jquery-1.11.3.min.js"></script>
    </head>
    <body>
        <?php
        require_once("./config.php");
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        
        // Biến kiểm tra thành công để dùng cho Script chuyển hướng ở dưới
        $isSuccess = ($secureHash == $vnp_SecureHash && $_GET['vnp_ResponseCode'] == '00');
        ?>
        
        <!-- Hiển thị kết quả cho người dùng -->
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">KẾT QUẢ THANH TOÁN VNPAY</h3>
            </div>
            <div class="table-responsive">
                <div class="form-group">
                    <label>Mã đơn hàng:</label>
                    <label><?php echo $_GET['vnp_TxnRef'] ?></label>
                </div>    
                <div class="form-group">
                    <label>Số tiền:</label>
                    <label><?php echo number_format($_GET['vnp_Amount']/100, 0, ',', '.') ?> VNĐ</label>
                </div>  
                <div class="form-group">
                    <label>Nội dung thanh toán:</label>
                    <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
                </div> 
                <div class="form-group">
                    <label>Mã phản hồi (vnp_ResponseCode):</label>
                    <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label>Mã GD Tại VNPAY:</label>
                    <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
                </div> 
                <div class="form-group">
                    <label>Mã Ngân hàng:</label>
                    <label><?php echo $_GET['vnp_BankCode'] ?></label>
                </div> 
                <div class="form-group">
                    <label>Thời gian thanh toán:</label>
                    <label><?php echo $_GET['vnp_PayDate'] ?></label>
                </div> 
                <div class="form-group">
                    <label>Kết quả:</label>
                    <label>
                        <?php
                        if ($secureHash == $vnp_SecureHash) {
                            if ($_GET['vnp_ResponseCode'] == '00') {
                                echo "<span style='color:blue; font-weight:bold;'>Giao dịch Thành công</span>";
                                echo "<p><small>Hệ thống sẽ tự động chuyển hướng sau 5 giây...</small></p>";
                            } else {
                                echo "<span style='color:red; font-weight:bold;'>Giao dịch Không thành công</span>";
                            }
                        } else {
                            echo "<span style='color:red; font-weight:bold;'>Chữ ký không hợp lệ (Sai cấu hình bảo mật)</span>";
                        }
                        ?>
                    </label>
                </div> 
            </div>
            <footer class="footer" style="margin-top: 20px;">
                   <p>&copy; VNPAY <?php echo date('Y')?></p>
            </footer>
        </div>

        <script>
            <?php if ($isSuccess): ?>
                setTimeout(function () {
                    window.location.href = '../order_status.php?order_id=<?php echo $_GET['vnp_TxnRef']; ?>';
                }, 5000)
            <?php else: ?>
                console.log("Thanh toán thất bại, không chuyển trang.");
            <?php endif; ?>
        </script>
    </body>
</html>
