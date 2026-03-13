<?php

session_start();
include("../layout/layout.php");

include("../controllers/user/userControl.php");
require_once("../config/database.php");
require_once("../services/user/userService.php");
require_once("../toast/toast.php");
$userService = new UserService($conn);
$toast = new ToastController();
$layout = new Layout();

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

<!-- <form method="POST">

<h2>Nhập OTP</h2>

<input name="otp" placeholder="Nhập mã OTP">

<button>Xác nhận</button>

</form> -->
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <title>Xác thực OTP</title>
        <link rel="stylesheet" href="../style/login.css">

    </head>

<body>

<?php echo $layout->getHeader(); ?>

    <div class="login-container">

        <div class="login-card">

            <h2>Xác thực OTP</h2>
            <form method="POST">
                <div class="input-group" style="gap: 10px;">
                    <label>Vui lòng nhập mã OTP đã gửi vào email của bạn</label>
                    <input 
                    type="text"
                    name="otp"
                    placeholder="Nhập mã OTP"
                    maxlength="6"
                    >
                    <button class="login-btn">
                        Xác nhận
                    </button>
                </div>
            </form>

        </div>

    </div>

<?php echo $layout->getFooter(); ?>

</body>
</html>