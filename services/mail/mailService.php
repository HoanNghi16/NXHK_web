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
            $mail->Subject = 'Ma OTP dang ky tai khoan';
            $mail->Body = "<h2>Ma OTP cua ban: $otp</h2>";

            $mail->send();

            return true;

        }catch(Exception $e){
            echo $e->getMessage();
        }

    }

}