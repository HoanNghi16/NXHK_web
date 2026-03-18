<?php
    session_start();
    include ('../layout/layout.php');
    include ('../controllers/user/userControl.php');
    $userControl = new userControl();
    $layout = new Layout();
    if (isset($_POST['email'])){
        $email = $_POST['email'];
        $userControl->forgetPassword($email);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='../style/login.css'></link>
    <script src='../js/formError.js'></script>
</head>
<body>
    <?php echo $layout->getHeader()?>
    <div class="loginContainer">
        <div class="loginCard">
            <h2>Xác thực email</h2>
            <form class='loginForm' method="POST">
                <div class="inputGroup">
                    <label>Email</label>
                    <input type="email" placeholder="Nhập email của bạn" name="email">
                </div>
                <button class='loginBtn'>Gửi mã OTP</button>
                <p class='registerText'>
                    <a href="./login.php">Quay lại trang đăng nhập</a>
                </p>
            </form>

        </div>
    </div>
    <?php echo $layout->getFooter()?>
</body>
</html>