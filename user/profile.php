<?php
session_start();
include("../layout/layout.php");
include("../controllers/user/userControl.php");

$layout = new Layout();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['submitChange']) && $_POST['submitChange'] =="submit"){
    $userControl = new userControl();
    $email = $_SESSION['user_email'];
    $new_email = $_POST['new_email'] ?? null;
    $new_name = $_POST['new_name'] ?? null;
    $password = $_POST['password'] ?? null;
    echo $email.$new_name;
    $userControl->changeProfile($email, $new_email, $new_name, $password);
}

if (isset($_POST['edit']) && $_POST['edit'] == 'editProfile'){
    echo '
        <script>
            function closeModal(){
                document.getElementById("modal").remove();
            }
        </script>
        <div class="modalBackground" id="modal" style="width: 100dvw; height: 100dvh; position: fixed; background-color: rgb(0,0,0,0.5); z-index: 1000;">
            <div class="loginCard" style="margin: 100px auto;">
                <button onclick="closeModal()" style="position: relative; top: 0px; right: 0px; left: 100%; width: 20px; height: 20px; background: none; color: white; border: none; font-size: 15px;">X</button>
                <form method="POST" class="loginForm">
                    <h2>Thay đổi hồ sơ</h2>
                    <h5 style="margin-bottom: 20px; text-align:center;">Hãy nhập thông tin bạn muốn thay đổi</h5>
                    <div class="inputGroup">
                        <label>Email mới</label>
                        <input type="email" name="new_email"/>
                    </div>
                    <div class="inputGroup">
                        <label>Họ và tên mới</label>
                        <input type="text" name="new_name"/>
                    </div>
                    <div class="inputGroup" >
                        <label>Xác nhận mật khẩu</label>
                        <input type="password" name="password"/>
                    </div>
                    <button class="loginBtn" name="submitChange" value="submit">Thay đổi</button>
                </form>
            </div>
        </div>';
}
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Hồ sơ cá nhân</title>
            <link rel="stylesheet" href="../style/profile.css">
            <link rel="stylesheet" href="../style/login.css">
        </head>

<body>

<?php echo $layout->getHeader(); ?>

<div class="profile-container">

    <div class="profile-card">

        <div class="profile-avatar">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
        </div>

        <h2 class="profile-name">
            <?php echo $_SESSION['user_name'] ?? "User"; ?>
        </h2>

        <div class="profile-info">

            <div class="info-item">
                <label>Email</label>
                <p><?php echo $_SESSION['user_email'] ?? "example@gmail.com"; ?></p>
            </div>

            <div class="info-item">
                <label>ID người dùng</label>
                <p><?php echo $_SESSION['user_id']; ?></p>
            </div>

        </div>
        <form method="POST">
            <button class="edit-btn" name="edit" value="editProfile">
                Chỉnh sửa hồ sơ
            </button>
        </form>
    </div>

</div>

<?php echo $layout->getFooter(); ?>

</body>
</html>