<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/../../vendor/autoload.php';

class MailService{

    public function sendOtp($email,$otp){

        $mail = new PHPMailer(true);
        try{

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $mail->Username = getenv('GMAIL');
            $mail->Password = getenv('PASSWORD');
            echo (json_encode($mail));

            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom();

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