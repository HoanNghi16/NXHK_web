<?php
    session_start();
    include ('../layout/layout.php');
    include('../controllers/user/userControl.php');
    $layout = new layout();
    $userControl = new userControl();
    if (isset($_POST['password']) && isset($_POST['confirmPassword'])){
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        if ($password === $confirmPassword){
            $userControl->newPassword($password);
        }else{
            $toast = new ToastController();
            $toast->showToast('Mật khẩu xác thực không đúng', 'error', 3000);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/login.css">
    <script src='../js/formError.js'></script>
</head>
<body>
    <?php
        echo $layout->getHeader();
    ?>
    <div class="loginContainer">
        <div class="loginCard">
            <form method="POST" class="loginForm">
                <h2>Đặt lại mật khẩu</h2>
                <div class="inputGroup">
                    <label>
                        Mật khẩu mới
                    </label>
                    <input name="password" type='password' id="inputPassword"/>
                    <span id="passwordError"></span>
                </div>
                <div class="inputGroup">
                    <label>Nhập lại mật khẩu</label>
                    <input name="confirmPassword" type="password"/>
                </div>
                <button class='loginBtn'>Đặt lại mật khẩu</button>
            </form>
        </div>
    </div>
    <?php
        echo $layout->getFooter();
    ?>
</body>
</html>