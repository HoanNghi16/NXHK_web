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

        <h2>Đăng ký</h2>

        <form class="login-form">

            <div class="input-group">
                <label>Họ và tên</label>
                <input type="text" placeholder="Nhập họ và tên">
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" placeholder="Nhập email">
            </div>

            <div class="input-group">
                <label>Mật khẩu</label>
                <input type="password" placeholder="Nhập mật khẩu">
            </div>

            <div class="input-group">
                <label>Xác nhận mật khẩu</label>
                <input type="password" placeholder="Nhập lại mật khẩu">
            </div>

            <div class="login-options">
                <label>
                    <input type="checkbox"> Tôi đồng ý với điều khoản
                </label>
            </div>

            <button class="login-btn">Tạo tài khoản</button>

            <p class="register-text">
                Đã có tài khoản?
                <a href="login.php">Đăng nhập</a>
            </p>

        </form>

    </div>

</div>

<?php
    $layout->getFooter();
?>

</body>
</html>