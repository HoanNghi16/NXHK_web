<?php
    session_start();
    include("../layout/layout.php");
    include('../controllers/user/userControl.php');
    $layout = new Layout();
    $userControl = new userControl();
    if(isset($_SESSION['user_id'])){
        header("Location: ../home.php");
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $userControl->login($email, $password);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../style/login.css">
</head>
<body>
    <?php
        echo $layout->getHeader();
    ?>
    <div class="loginContainer">
        
        <div class="loginCard">

            <h2>Đăng nhập</h2>

            <form class="loginForm" name="loginForm" method="POST">

                <div class="inputGroup">
                    <label>Email</label>
                    <input type="email" placeholder="Nhập email của bạn" name="email">
                </div>

                <div class="inputGroup">
                    <label>Mật khẩu</label>
                    <input type="password" placeholder="Nhập mật khẩu" name="password">
                </div>

                <div class="loginOptions">
                    <a href="./forgetPassword.php">Quên mật khẩu?</a>
                </div>

                <button class="loginBtn">Đăng nhập</button>

                <p class="registerText">
                    Chưa có tài khoản?
                    <a href="register.php">Đăng ký</a>
                </p>

            </form>

        </div>

    </div>
    <?php
        echo $layout->getFooter();
    ?>
</body>
</html>