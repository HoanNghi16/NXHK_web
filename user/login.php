<?php
    include("../layout/layout.php");
    $layout = new Layout();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../style/login.css">
</head>
<body>
    <?php
        $layout->getHeader();
    ?>
    <div class="login-container">
        
        <div class="login-card">

            <h2>Đăng nhập</h2>

            <form class="login-form">

                <div class="input-group">
                    <label>Email</label>
                    <input type="email" placeholder="Nhập email của bạn">
                </div>

                <div class="input-group">
                    <label>Mật khẩu</label>
                    <input type="password" placeholder="Nhập mật khẩu">
                </div>

                <div class="login-options">
                    <label>
                        <input type="checkbox"> Ghi nhớ đăng nhập
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