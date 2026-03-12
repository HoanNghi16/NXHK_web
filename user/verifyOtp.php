<?php

session_start();

include("../controllers/user/userControl.php");
require_once("../config/database.php");
require_once("../services/user/userService.php");
require_once("../toast/toast.php");

$userService = new UserService($conn);
$toast = new ToastController();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $otp = $_POST["otp"];

    $result = $userService->verifyOtp($otp);

    if($result === true){

        $toast->showToast("Đăng ký thành công","success",3000);

        header("Location: login.php");
        exit();

    }else{
        $toast->showToast($result,"error",3000);
    }

}

?>

<form method="POST">

<h2>Nhập OTP</h2>

<input name="otp" placeholder="Nhập mã OTP">

<button>Xác nhận</button>

</form>