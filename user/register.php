<?php
    session_start();
    include("../layout/layout.php");
    include('../controllers/user/userControl.php');
    $layout = new Layout();
    $userControl = new userControl();
    if(isset($_SESSION['user_id'])){
        $toast = new ToastController();
        header("Location: ../home.php");
        $toast->showToast("Bạn đã đăng nhập", "null", 3000);
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $confirmPassword = $_POST["confirmPassword"];
        $userControl->register($email, $password, $name, $confirmPassword);
    }
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
    echo $layout->getHeader();
?>

<div class="login-container">
        
    <div class="login-card">

        <h2>Đăng ký</h2>

        <form class="login-form" method="POST">

            <div class="input-group">
                <label>Họ và tên</label>
                <input type="text" placeholder="Nhập họ và tên" name="name">
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" placeholder="Nhập email" name="email">
            </div>

            <div class="input-group">
                <label>Mật khẩu</label>
                <input type="password" placeholder="Nhập mật khẩu" name="password">
            </div>

            <div class="input-group">
                <label>Xác nhận mật khẩu</label>
                <input type="password" placeholder="Nhập lại mật khẩu" name="confirmPassword">
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
    echo $layout->getFooter();
?>

</body>
</html>