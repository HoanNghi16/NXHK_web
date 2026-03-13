<?php
    session_start();
    include("../layout/layout.php");
    include('../controllers/user/userControl.php');
    $layout = new Layout();
    $userControl = new userControl();
    if(isset($_SESSION['user_id'])){
        header("Location: ../home.php");
        $toast->showToast("Bạn đã đăng nhập", "null", 3000);
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST['accept'])){
            $toast = new ToastController();
            $toast->showToast("Vui lòng đồng ý với điều khoản", "error", 3000);
        }
        else{
            $email = $_POST["email"];
            $password = $_POST["password"];
            $name = $_POST["name"];
            $confirmPassword = $_POST["confirmPassword"];
            $userControl->register($email, $password, $name, $confirmPassword);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../style/login.css">
    <script src="../js/formError.js"></script>
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
                <input type="text" placeholder="Nhập họ và tên" name="name" onblur="validName(this)" onkeyup="validName(this)">
                <span style="color: #aa0a0a; font-size: 14px; margin-top: 3px;" class="input-error" id="name-error"></span>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" placeholder="Nhập email" name="email" onblur="validEmail(this)" onkeyup="validEmail(this)">
                <span style="color: #aa0a0a; font-size: 14px; margin-top: 3px;" class="input-error" id="email-error"></span>
            </div>

            <div class="input-group">
                <label>Mật khẩu</label>
                <input type="password" placeholder="Nhập mật khẩu" name="password" onblur="validPassword(this)" onkeyup="validPassword(this)">
                <span style="color: #aa0a0a; font-size: 14px; margin-top: 3px;" class="input-error" id="password-error"></span>
            </div>

            <div class="input-group">
                <label>Xác nhận mật khẩu</label>
                <input type="password" placeholder="Nhập lại mật khẩu" name="confirmPassword">
            </div>

            <div class="login-options">
                <label>
                    <input type="checkbox" name="accept"> Tôi đồng ý với điều khoản
                </label>
            </div>

            <button type="submit" class="login-btn" id="signin-btn">Tạo tài khoản</button>

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