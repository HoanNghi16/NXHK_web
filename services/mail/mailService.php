<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require __DIR__.'/../../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->load();

class MailService{

    public function sendOtp($email,$otp){
        $mail = new PHPMailer(true);
        try{

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $mail->Username = $_ENV['GMAIL'];
            $mail->Password = $_ENV['PASSWORD'];

            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($_ENV['GMAIL'], "NXHK Shop");

            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'NXHK Neo Store';
            $mail->Body = "<h2>Mã OTP của bạn: $otp</h2>";

            $mail->send();

            return true;

        }catch(Exception $e){
            echo $e->getMessage();
        }

    }

    public function sendOrderMail($order) {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        
        $itemsHtml = "<table border='1' cellpadding='8' cellspacing='0' style='border-collapse: collapse; width:100%'>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
        ";
        echo "<pre>";
        print_r($order['items']);
        die();
        foreach ($order['items'] as $item) {
            $itemsHtml = "
                <table border='1' cellpadding='8' cellspacing='0' style='border-collapse: collapse; width:100%'>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>
                    <tr>
                        <td>{$item['product_name']}</td>
                        <td>{$item['quantity']}</td>
                        <td>" . number_format($item['price'] * $item['quantity'], 0, ',', '.') . " VNĐ</td>
                    </tr>
                </table>
                ";
        }
        $itemsHtml .= "</table>";
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['GMAIL'];
            $mail->Password   = $_ENV['PASSWORD'];
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom($_ENV['GMAIL'], 'Shop của bạn');
            $mail->addAddress($order['customer_email'], $order['customer_name']);

            $mail->isHTML(true);
            $mail->Subject = 'Xác nhận đơn hàng #' . $order['order_code'];

            $orderLink = "http://localhost/NXHK_web/order_status.php?order_id=" . $order['order_code'];

            $mail->Body = "
                <h2>Cảm ơn bạn đã đặt hàng tại NeoTech Store</h2>
                <p><b>Mã đơn:</b> {$order['order_code']}</p>
                <p><b>Ngày đặt:</b> " . date("d/m/Y H:i", strtotime($order['created_at'])) . "</p>
                <p><b>Người nhận:</b> {$order['customer_name']}</p>
                <p><b>Email:</b> {$order['customer_email']}</p>
                <p><b>Số điện thoại:</b> {$order['customer_phone']}</p>
                <p><b>Địa chỉ:</b> {$order['customer_address']}</p>
                <p><b>Ghi chú:</b> {$order['order_note']}</p>
                <p><b>Phương thức thanh toán:</b> {$order['payment_method']}</p>
                <p><b>Danh sách sản phẩm:</b></p>
                {$itemsHtml}
                <p><b>Tổng tiền:</b> " . number_format($order['amount'], 0, ',', '.') . " VNĐ</p>
                <p><b>Dự kiến nhận hàng:</b> 2 - 3 ngày tới</p>
                <p><b>Bạn có thể theo dõi đơn hàng tại đây:</b> 
                <a href='{$orderLink}' target='_blank'>Theo dõi đơn hàng</a></p>
            ";

            $mail->send();
            return true;

        } catch (Exception $e) {
            error_log("Send mail failed: " . $mail->ErrorInfo);
            return false;
        }
    }

}