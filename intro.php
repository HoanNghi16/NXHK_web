<?php
    session_start();
    include("./layout/layout.php");
    $layout = new Layout();
?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới thiệu | NeoTech</title>

    <link rel="stylesheet" href="./style/intro.css">

</head>

<body>

<?php echo $layout->getHeader(); ?>

<div class="container">

    <section class="intro-hero">

        <h1>NeoTech</h1>

        <p>
            NeoTech là website bán đồ công nghệ được xây dựng nhằm mang đến trải nghiệm mua sắm 
            thiết bị công nghệ hiện đại, tiện lợi và nhanh chóng cho người dùng.
        </p>

    </section>

    <section class="project-info">

        <h2>Thông tin đề tài</h2>

        <div class="info-box">
            
            <p><strong>Học phần:</strong> Phát triển ứng dụng Web</p>

            <p><strong>Tên đề tài:</strong> Website bán đồ công nghệ NeoTech</p>

            <p><strong>Lớp:</strong> DHHTTT19A</p>

            <p><strong>Giảng viên hướng dẫn:</strong> Võ Ngọc Tấn Phước</p>

        </div>

    </section>

    <section class="team">

        <h2>Nhóm thực hiện</h2>

        <div class="team-grid">

            <div class="member-card">
                <img src="../img/nghi.jpg" class="avatar">
                <h3>Nguyễn Dương Hoàng Nghi</h3>
                <p>hoangnghinguyen17@gmail.com</p>
            </div>

            <div class="member-card">
                <img src="../img/hong.jpg" class="avatar">
                <h3>Nguyễn Thị Hồng</h3>
                <p>hazelpnk55@gmail.com</p>
            </div>

            <div class="member-card">
                <img src="../img/xuyen.jpg" class="avatar">
                <h3>Võ Thị Mỹ Xuyến</h3>
                <p>myxuyenvo31@gmail.com</p>
            </div>

            <div class="member-card">
                <img src="../img/khanh.jpg" class="avatar">
                <h3>Trần Quốc Khánh</h3>
                <p>yasuokhanh16@gmail.com</p>
            </div>

        </div>

    </section>


    <section class="teacher">

        <h2>Giảng viên hướng dẫn</h2>

        <div class="teacher-card">

            <img src="../img/teacher.jpg" class="avatar">

            <h3>Võ Ngọc Tấn Phước</h3>

            <p>Giảng viên hướng dẫn</p>

        </div>

    </section>

    <section class="about-project">

        <h2>Mục tiêu của dự án</h2>

        <p>
            Dự án NeoTech được xây dựng nhằm mô phỏng một hệ thống website thương mại điện tử 
            chuyên bán các sản phẩm công nghệ như laptop, điện thoại, thiết bị gaming và phụ kiện.
            Website cung cấp các chức năng như xem sản phẩm, tìm kiếm, đăng ký tài khoản, đăng nhập,
            quản lý giỏ hàng và đặt hàng trực tuyến.
        </p>

    </section>

</div>

<?php echo $layout->getFooter(); ?>

</body>
</html>