<?php
session_start();
include("../layout/layout.php");

$layout = new Layout();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hồ sơ cá nhân</title>
<link rel="stylesheet" href="../style/profile.css">
</head>

<body>

<?php echo $layout->getHeader(); ?>

<div class="profile-container">

    <div class="profile-card">

        <div class="profile-avatar">
            <img src="../assets/default-avatar.png">
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

        <button class="edit-btn">
            Chỉnh sửa hồ sơ
        </button>

    </div>

</div>

<?php echo $layout->getFooter(); ?>

</body>
</html>