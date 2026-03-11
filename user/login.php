<?php
    include("../layout/layout.php");
    include('../controller/user/userControl.php');
    $layout = new Layout();
    $userControl = new userControl();
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
        $layout->getHeader();
    ?>
    <div class="login-container">
        
        <div class="login-card">

            <h2>Đăng nhập</h2>

            <form class="login-form" name="loginForm" method="POST">

                <div class="input-group">
                    <label>Email</label>
                    <input type="email" placeholder="Nhập email của bạn" name="email">
                </div>

                <div class="input-group">
                    <label>Mật khẩu</label>
                    <input type="password" placeholder="Nhập mật khẩu" name="password">
                </div>

                <div class="login-options">
                    <label>
                        <input type="checkbox" name="remember"> Ghi nhớ đăng nhập
                    </label>

                    <a href="#">Quên mật khẩu?</a>
                </div>

                <button class="login-btn">Đăng nhập</button>

                <p class="register-text">
                    Chưa có tài khoản?
                    <a href="register.php">Đăng ký</a>
                </p>

            </form>

        </div>

    </div>
    <?php
        $layout->getFooter();
    ?>
</body>
</html>